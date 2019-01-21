#include "hpc_helpers.hpp"
#include <iostream>
#include <cstdint>
#include <omp.h>
#include <random>

#define MAX 0
#define MIN 9999
#define min(x,y) (x<y ? x:y)
#define max(x,y) (x>y ? x:y)


using namespace std;

void initCurve(vector< vector<float> > &data, uint64_t dim, uint64_t pt_num, float offset){
	mt19937 engine(42+offset);
	float low = offset*(-1) - 1;
	float high = offset + 1;
    uniform_real_distribution<float> density(low, high);
    vector<float> aux_point(dim);

    for (uint64_t i = 0; i < pt_num; i++)
    {
    	for (uint64_t j = 0; j < dim; ++j)
    	{ 
    		aux_point[j] = density(engine);
    	}
    	data[i] = aux_point;
    }
}

vector<float> distanciaEuclidiana(vector< vector<float> > &a_curve, vector< vector<float> > &b_curve, uint64_t pnt_count, uint64_t dim){
	vector<float> delta(dim), a_comp(dim), b_comp(dim), dist(pnt_count);
	

	float tmp = 0;
//	cout <<" abtes del paralel for " << omp_get_thread_num() <<endl;
	#pragma omp parallel for
	for (int i = 0; i < pnt_count; ++i)
	{	
	
//		#pragma omp critical
//		cout <<" dentro del for " << omp_get_thread_num() <<endl;
	
		a_comp = a_curve[i];				 
		b_comp = b_curve[i];				
		
		float acc = 0;			

		#pragma omp simd reduction(+:acc)
		for (int j = 0; j < dim; ++j)
		{
			acc = b_comp[j] - a_comp[j];
			delta[j] = acc;
		}

		#pragma omp simd reduction(+:tmp)
		for (int k = 0; k < dim; ++k)
		{
			tmp += delta[k] * delta[k];
		}

		//#pragma omp critical
		dist[i] = tmp;		
	}
	return dist;				
}

float getMinDist(vector<float> &a, uint64_t size){
	float minval = MIN;

	#pragma omp parallel for reduction(min:minval)
	for (int i = 0; i < size; ++i)
	{
		if (a[i] < minval)
		{
			minval = a[i];
		}
	}
	return minval;
}

float getMaxDist(vector<float> &a, uint64_t size){
	float maxval = MAX;

	#pragma omp parallel for reduction(max:maxval)
	for (int i = 0; i < size; ++i)
	{
		if (a[i] > maxval)
		{
			maxval = a[i];
		}
	}
	return maxval;
}

int main(int argc, char const *argv[])
{
	int M, K, N, D;

	M = atoi(argv[1]);
	K = atoi(argv[2]);
	N = atoi(argv[3]);
	D = atoi(argv[4]);

//	cout <<"grupos: "<< M << " kurvas: " << K <<" n° puntos: " << N << " Dimension: " << D << endl;

	vector< vector<float> > curvasK(N*D);
	vector< vector< vector<float> > > gruposM(K*N*D);

	TIMERSTART(TEST)
	for (int i = 0; i < M; i++)
	{
		for (int j = 0; j < K; j++)
		{
			initCurve(curvasK, D, N, (i+1)*j);
			gruposM[j] = curvasK;
		}

		vector<float> euclidiano, min_group, max_group;
		float min_dist, max_dist;
		vector< vector<float> > vectorDistancias;
		
		for (int k = 0; k < K; k++)
		{
			for (int l = 0; l < K; l++)
			{
				if (l != k)
				{
					euclidiano = distanciaEuclidiana(gruposM[k], gruposM[l], N, D);
					vectorDistancias.push_back(euclidiano);
				}
			}		
		}

		for (int m = 0; m < vectorDistancias.size(); m++)
		{
			min_dist = getMinDist(vectorDistancias[m], vectorDistancias[m].size());
			max_dist = getMaxDist(vectorDistancias[m], vectorDistancias[m].size());
			min_group.push_back(min_dist);
			max_group.push_back(max_dist);
		}
//		cout << "min: " << sqrt(getMinDist(min_group, min_group.size())) << " max: " << sqrt(getMaxDist(max_group, max_group.size())) << endl; 
	}
	TIMERSTOP(TEST)
		

	return 0;
}