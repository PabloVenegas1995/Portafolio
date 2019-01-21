#include <stdio.h>
#include <iostream>
#include <cuda_runtime.h>


using namespace std;

__global__ void allreduce(int *in, int *out) {
	int id = blockDim.x*blockIdx.x + threadIdx.x;
	int thid = threadIdx.x;
	int bdim = blockDim.x;
	int bid = blockIdx.x;

	extern __shared__ int sharray[];
	sharray[thid] = in[id]; 

	// todas las hebras en su bloque escriben en mem compartida
	// luego hay que esperar que todas terminn
	__syncthreads();

	//for(int i=bdim/2; i > 0; i >>= 1){
	for(int i=bdim/2; i > 0; i/=2){
		//printf(" i %d thid %d bid %d\n", i, thid, bid);
		if(thid < i){
			sharray[thid] += sharray[thid + i];
		}
		__syncthreads();
	}

	if(thid == 0){
		out[bid] = sharray[0];
	}

}

void initA(int *in, int N){
        for(int i=0; i<N; i++)
                in[i] = i;
}

void print(int *in, int N){
        for(int i=0; i<N; i++)
                printf("%d ", in[i]);
        printf("\n");
}


int main(int argc, char *argv[]){
	
	if(argc != 3){
		cout<<" USO "<<argv[0]<<" N K (Threads/Block)\n";
		return 1;
	}

	int N = atoi(argv[1]);
        int K = atoi(argv[2]);
	int midev;
        cudaGetDevice(&midev);

	cout<<" N "<<N<<" K "<<K<<endl;
        int nb = (N+1)/K;
	cout<<" K "<<K<<" nb "<<nb<<" nb * sizeof(int) "<<nb*sizeof(int)<<endl;

        int size = N*sizeof(int);
        int *in = (int *)malloc(size);
        int *oner = (int *)malloc(sizeof(int));

        initA(in,N);
        print(in,N);

	int *d_in, *d_out, *d_one;
	cudaMalloc(&d_in, size);
	cudaMalloc(&d_out, nb*sizeof(int));
	cudaMalloc(&d_one, sizeof(int));
	cudaMemcpy(d_in, in, size, cudaMemcpyHostToDevice);
	
        int tpb = K;
        int sharebytes = K*sizeof(int);
	//TIMERSTART(allreduce)
	allreduce<<<nb,tpb,sharebytes>>>(d_in,d_out); //blocks = N/K  

        cudaError_t err = cudaGetLastError();
        if (err != cudaSuccess) 
                std::cout<<"Error: "<<cudaGetErrorString(err)<<std::endl;

	tpb = nb;

	allreduce<<<1,tpb,sharebytes>>>(d_out,d_one); //blocks = N/K  
	//TIMERSTOP(allreduce)

	cudaMemcpy(oner, d_one, sizeof(int), cudaMemcpyDeviceToHost);

	cudaFree(d_in);
	cudaFree(d_out);
	cudaFree(d_one);

	cout<<" out\n";
	cout<<" oner "<<*oner<<endl;

	free(in);
	free(oner);

	cout<<" fin \n";
}
