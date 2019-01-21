#include <cuda_runtime.h>
#include "CImg.h"
#include <stdio.h>
#include <iostream>

using namespace std;
using namespace cimg_library;

/*__global__ void rgbsame(unsigned char * d_src, unsigned char * d_dst, int width, int height)
{
    int x = blockIdx.x * blockDim.x + threadIdx.x;
    int y = blockIdx.y * blockDim.y + threadIdx.y;

    if (x >= width || y >= height)
        return;

    unsigned char r = d_src[y * width + x];
    unsigned char g = d_src[(height + y ) * width + x];
    unsigned char b = d_src[(height * 2 + y) * width + x];

    d_dst[y * width + x] = r;
    d_dst[(height + y)*width +x] = g;
    d_dst[(height * 2 + y)*width +x] = b;

}*/

__global__ void gray(unsigned char *d_src, unsigned char * d_dst, int width, int height, int proporcion){
    int x = blockIdx.x * blockDim.x + threadIdx.x;
    int y = blockIdx.y * blockDim.y + threadIdx.y;


//int height_d = height/2, width_d = width/2;
    if (x >= width || y >= height)return;
if(x%2 == 0 && y%2 != 0){
    unsigned char r = d_src[y * width + x];
    unsigned char g = d_src[(height + y ) * width + x];
    unsigned char b = d_src[(height * 2 + y) * width + x];

    d_dst[(y/proporcion * width/proporcion + x/proporcion)] = r;
    d_dst[((height/proporcion + y/proporcion)*width/proporcion +x/proporcion)] = g;
    d_dst[((height*2/proporcion + y/proporcion)*width/proporcion +x/proporcion)] = b;
	}
}

int main(int argc, char *argv[]) {

    if(argc != 2){
        cout<<"uso: "<<argv[0]<<" image "<<endl;
    }

    CImg<unsigned char> src(argv[1]);
    string out = string(argv[1]) + ".gray";
	
    int proporcion = atoi(argv[2]);

    int width = src.width();
    int height = src.height();

	cout << " width " << width << " height " << height << endl;

    unsigned long size = src.size();
    cout<<" src size "<<size<<endl;

    unsigned char *h_src = src.data();

    CImg<unsigned char> dst(width/proporcion, height/proporcion, 1, 3);
    unsigned char *h_dst = dst.data();
    cout<<" dst size "<<dst.size()<<endl;

    unsigned char *d_src;
    unsigned char *d_dst;

    cudaMalloc((void**)&d_src, size);
    cudaMalloc((void**)&d_dst, size/(proporcion*proporcion)*sizeof(unsigned char));

    cudaMemcpy(d_src, h_src, size, cudaMemcpyHostToDevice);

    dim3 blkDim (16, 16, 1);
    dim3 grdDim ((width + 15)/16, (height + 15)/16, 1);

    gray<<<grdDim, blkDim>>>(d_src, d_dst, width, height, proporcion);

    cudaMemcpy(h_dst, d_dst, size/(proporcion*proporcion), cudaMemcpyDeviceToHost);

    cudaFree(d_src);
    cudaFree(d_dst);
    dst.save(out.c_str());
    dst.display();
 

    return 0;
}
