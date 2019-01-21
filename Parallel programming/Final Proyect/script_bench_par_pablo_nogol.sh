#!/bin/bash
	g++ -std=c++11 -o rndwalk_pablo_noGoL randomwalk_par_pablo_nogol.cpp -fopenmp

REGEX='[0-9]*.[0-9\-]*[e-]*[0-9]$'
j=1
while [[ $j -le 3 ]]; do
	i=1
	while [[ $i -le 12 ]]; do
		export OMP_NUM_THREADS=$i
		./rndwalk_pablo_noGoL 2000 2500 10 | grep -o $REGEX >> benchmark_pablo_nogol.txt
		let i=i+1 
	done
let j=j+1
done