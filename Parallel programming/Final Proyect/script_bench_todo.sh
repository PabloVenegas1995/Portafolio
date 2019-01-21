#!/bin/bash
	g++ -std=c++11 -o rndwalk_paper randomwalk_paper_par_v3.cpp -fopenmp
	g++ -std=c++11 -o rndwalk_paper_nogol randomwalk_paper_par_v3_nogol.cpp -fopenmp
	g++ -std=c++11 -o rndwalk_pablo randomwalk_par_pablo.cpp -fopenmp
	g++ -std=c++11 -o rndwalk_pablo_nogol randomwalk_par_pablo_nogol.cpp -fopenmp
	
REGEX='[0-9]*.[0-9\-]*[e-]*[0-9]$'
j=1
while [[ $j -le 10 ]]; do
	i=1
	while [[ $i -le 12 ]]; do
		export OMP_NUM_THREADS=$i
		./rndwalk_paper 128 512 10 | grep -o $REGEX >> benchmark_paper_128.txt
		./rndwalk_paper_nogol 128 512 10 | grep -o $REGEX >> benchmark_paper_nogol_128.txt
		./rndwalk_pablo 128 512 10 | grep -o $REGEX >> benchmark_pablo_128.txt
		./rndwalk_pablo_nogol 128 512 10 | grep -o $REGEX >> benchmark_pablo_nogol_128.txt
		let i=i+1 
	done
let j=j+1
done
j=1
while [[ $j -le 10 ]]; do
	i=1
	while [[ $i -le 12 ]]; do
		export OMP_NUM_THREADS=$i
		./rndwalk_paper 256 1024 10 | grep -o $REGEX >> benchmark_paper_256.txt
		./rndwalk_paper_nogol 256 1024 10 | grep -o $REGEX >> benchmark_paper_nogol_256.txt
		./rndwalk_pablo 256 1024 10 | grep -o $REGEX >> benchmark_pablo_256.txt
		./rndwalk_pablo_nogol 256 1024 10 | grep -o $REGEX >> benchmark_pablo_nogol_256.txt
		let i=i+1 
	done
let j=j+1
done
j=1
while [[ $j -le 10 ]]; do
	i=1
	while [[ $i -le 12 ]]; do
		export OMP_NUM_THREADS=$i
		./rndwalk_paper 512 1536 10 | grep -o $REGEX >> benchmark_paper_512.txt
		./rndwalk_paper_nogol 512 1536 10 | grep -o $REGEX >> benchmark_paper_nogol_512.txt
		./rndwalk_pablo 512 1536 10 | grep -o $REGEX >> benchmark_pablo_512.txt
		./rndwalk_pablo_nogol 512 1536 10 | grep -o $REGEX >> benchmark_pablo_nogol_512.txt
		let i=i+1 
	done
let j=j+1
done
j=1
while [[ $j -le 10 ]]; do
	i=1
	while [[ $i -le 12 ]]; do
		export OMP_NUM_THREADS=$i
		./rndwalk_paper 1024 2560 10 | grep -o $REGEX >> benchmark_paper_1024.txt
		./rndwalk_paper_nogol 1024 2560 10 | grep -o $REGEX >> benchmark_paper_nogol_1024.txt
		./rndwalk_pablo 1024 2560 10 | grep -o $REGEX >> benchmark_pablo_1024.txt
		./rndwalk_pablo_nogol 1024 2560 10 | grep -o $REGEX >> benchmark_pablo_nogol_1024.txt
		let i=i+1 
	done
let j=j+1
done
j=1
while [[ $j -le 10 ]]; do
	i=1
	while [[ $i -le 12 ]]; do
		export OMP_NUM_THREADS=$i
		./rndwalk_paper 2048 4096 10 | grep -o $REGEX >> benchmark_paper_2048.txt
		./rndwalk_paper_nogol 2048 4096 10 | grep -o $REGEX >> benchmark_paper_nogol_2048.txt
		./rndwalk_pablo 2048 4096 10 | grep -o $REGEX >> benchmark_pablo_2048.txt
		./rndwalk_pablo_nogol 2048 4096 10 | grep -o $REGEX >> benchmark_pablo_nogol_2048.txt
		let i=i+1 
	done
let j=j+1
done
