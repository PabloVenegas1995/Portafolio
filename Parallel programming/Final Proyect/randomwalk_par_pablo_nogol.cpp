#include <iostream>
#include <vector>
#include <omp.h>
#include <random>
#include "hpc_helpers.h"
#include <unistd.h>

using namespace std;

int N, max_tun, max_tunel_len;
vector< vector<bool> > map_grid;

// direcciones posibles
int directions[8][2] = { {-1,0}, {1,0}, {0,-1}, {0,1},{-1,1}, {1,1}, {1,-1}, {-1,-1} };

void initMap(int dim){
	map_grid.resize(dim);
	#pragma omp parallel
	{
		#pragma omp for
		for (int i = 0; i < dim; ++i)
			for (int j = 0; j < dim; ++j)
				map_grid[i].push_back(1);	
	}
}

void printMap(int dim){
	for (int i = 0; i < dim; ++i)
	{
		for (int j = 0; j < dim; ++j)
		{
			if(map_grid[i][j] == 1) cout << " " << " ";
			else cout << (char)223 << " ";
		}
		cout << endl;
	}
}

int random_position(int lower, int upper){
	random_device rd;
	mt19937 gen(rd());
    uniform_int_distribution<int> rand_num(lower, upper);
    return rand_num(gen);
}

void random_walk_generation(int initx, int inity, int finx, int finy){
	
	// escojer punto de partida
	int curr_row = random_position(initx,finx-1), curr_column = random_position(inity,finy-1);
	int randomDir[2], lastDir[2];
	int n_th = omp_get_num_threads();
	int th_max_tun = max_tun/n_th, th_max_tunel_len = max_tunel_len;
	
	while( th_max_tun > 0 )
	{
		do {
			int d = random_position(0,7);
			randomDir[0] = directions[d][0];
			randomDir[1] = directions[d][1];
		} while( (randomDir[0] == (-1)*lastDir[0] && randomDir[1] == (-1)*lastDir[1]) || (randomDir[0] == lastDir[0] && randomDir[1] == lastDir[1]) );

		int rand_tunel_len = random_position(1,th_max_tunel_len-1), curr_tunel_len;

		for (curr_tunel_len = 0; curr_tunel_len < rand_tunel_len; curr_tunel_len++){
			if (curr_row < 0 || curr_column < 0){
				continue;
			}
			//terminar loop si se sale de los bordes
			if ( ((curr_row == 1) && (randomDir[0] == -1)) ||
				 ((curr_column == 1) && (randomDir[1] == -1)) ||
				 ((curr_row == N-2) && (randomDir[0] == 1)) ||
				 ((curr_column == N-2) && (randomDir[1] == 1)) ) {
				
				break;
			} else {
				map_grid[curr_row][curr_column] = 0;
				curr_row += randomDir[0];
				curr_column += randomDir[1];
			}
		}

		if (curr_tunel_len)
		{
			lastDir[0] = randomDir[0];
			lastDir[1] = randomDir[1];
			th_max_tun--;
		}
	}
}

int countAliveNeighbours(int i, int j){
	
	int alive = 0;
	for (int ii = -1; ii < 2; ++ii)
	{
		for (int jj = -1; jj < 2; ++jj)
		{
			int neigh_x = i + ii;
			int neigh_y = j + jj;
			if (ii == 0 && jj == 0)
				continue;
			else if (neigh_x < 1 || neigh_y < 1 || neigh_x > N-2 || neigh_y > N-2)
				alive += 1;
			else if (map_grid[neigh_x][neigh_y] == 1)
				alive += 1;
			//alive += map_grid[i+ii][j+jj];
		}
	}
	return alive;
}

void applyGameOfLife(int initx, int inity, int finx, int finy){
	int liveLimit = 3, deathLimit = 7, k = 0;
	bool stepSubMap[finx+1][finy+1];

	while(k < 5)
	{
		for (int i = initx; i < finx; ++i){
			for (int j = inity; j < finy; ++j){
				stepSubMap[i][j] = map_grid[i][j];	
			}
		}

		for (int i = initx; i < finx; ++i)
		{
			for (int j = inity; j < finy; ++j)
			{
				int alive = countAliveNeighbours(i,j);
				if (map_grid[i][j])
				{
					if (alive < deathLimit) stepSubMap[i][j] = 0;
					else stepSubMap[i][j] = 1;
				} else {
					if (alive > liveLimit) stepSubMap[i][j] = 0;
					else stepSubMap[i][j] = 1;
				}
			}
		}
			
		for (int i = initx; i < finx; ++i)
			for (int j = inity; j < finy; ++j) 
				map_grid[i][j] = stepSubMap[i][j];

		k++;
	}
}

void removeAlone(){
	#pragma omp parallel
	{
		#pragma omp for collapse(2)
		for (int i = 0; i < N; ++i)
		{
			for (int j = 0; j < N; ++j)
			{
				//#pragma omp critical
				//cout << "th: " << omp_get_thread_num() << endl;
				int alive = countAliveNeighbours(i,j);
				if (alive < 3)
				{
					map_grid[i][j] = 0;
				}
			}
		}	
	}
}


int main(int argc, char const *argv[]){

	srand(time(nullptr));
	N = atoi(argv[1]);
	max_tun=atoi(argv[2]);
	max_tunel_len = atoi(argv[3]);

	int inicio[16][2] = { {1,1},{1,N/4},{1,N/2},{1,(3*N)/4},{N/4,1},{N/4,N/4},{N/4,N/2},{N/4,(3*N)/4},{N/2,1},{N/2,N/4},{N/2,N/2},{N/2,(3*N)/4},{(3*N)/4,1},{(3*N)/4,N/4},{(3*N)/4,N/2},{(3*N)/4,(3*N)/4}  };
	int final [16][2] = { {N/4,N/4},{N/4,N/2},{N/4,(3*N)/4},{N/4,N},{N/2,N/4},{N/2,N/2},{N/2,(3*N)/4},{N/2,N},{(3*N)/4,N/4},{(3*N)/4,N/2},{(3*N)/4,(3*N)/4},{(3*N)/4,N},{N,N/4},{N,N/2},{N,(3*N)/4},{N,N}  };
	
	
	initMap(N);
	TIMERSTART(random_walk)

	#pragma omp parallel
	{
//		cout << "th: " << omp_get_thread_num() << endl;
		random_walk_generation(3*N/5,3*N/5,4*N/5,4*N/5);
	}
		
	TIMERSTOP(random_walk)

	//printMap(N);

	return 0;
}