
g++-5 tarea2paralela.cpp -o tarea2 -std=c++11  -fopenmp

TIEMPO='[0-9]*.[0-9\-]*[e-]*[0-9]$'


contador=1
i=4
while [[ $contador -le 3 ]]; do
	#prueba con aumentando cantidad de curvas K, mantieniendo los demás parámetros y cantidad de threads
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=1
		./tarea2 1 $i 100 2 | grep -o $TIEMPO >> benchmark_K_1th.txt
		let i=i*2 
	done
	i=4
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=4
		./tarea2 1 $i 100 2 | grep -o $TIEMPO >> benchmark_K_4th.txt
		let i=i*2 
	done
	i=4
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=8
		./tarea2 1 $i 100 2 | grep -o $TIEMPO >> benchmark_K_8th.txt
		let i=i*2 
	done
	i=4
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=12
		./tarea2 1 $i 100 2 | grep -o $TIEMPO >> benchmark_K_12th.txt
		let i=i*2 
	done
	i=4
	let contador=contador+1
done

contador=1
i=4
while [[ $contador -le 3 ]]; do
	#prueba con aumentando cantidad de puntos N, mantieniendo los demás parámetros y cantidad de threads
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=1
		./tarea2 1 100 $i 2 | grep -o $TIEMPO >> benchmark_N_1th.txt
		let i=i*2 
	done
	i=4
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=4
		./tarea2 1 100 $i 2 | grep -o $TIEMPO >> benchmark_N_4th.txt
		let i=i*2 
	done
	i=4
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=8
		./tarea2 1 100 $i 2 | grep -o $TIEMPO >> benchmark_N_8th.txt
		let i=i*2 
	done
	i=4
	while [[ $i -le 256 ]]; do
		export OMP_NUM_THREADS=12
		./tarea2 1 100 $i 2 | grep -o $TIEMPO >> benchmark_N_12th.txt
		let i=i*2 
	done
	i=4
	let contador=contador+1
done

contador=1
i=2
while [[ $contador -le 3 ]]; do
	#prueba con aumentando la dimension D de los puntos, mantieniendo los demás parámetros y cantidad de threads
	while [[ $i -le 50 ]]; do
		export OMP_NUM_THREADS=1
		./tarea2 1 100 100 $i | grep -o $TIEMPO >> benchmark_D_1th.txt
		let i=i+2 
	done
	i=2
	while [[ $i -le 50 ]]; do
		export OMP_NUM_THREADS=4
		./tarea2 1 100 100 $i | grep -o $TIEMPO >> benchmark_D_4th.txt
		let i=i+2 
	done
	i=2
	while [[ $i -le 50 ]]; do
		export OMP_NUM_THREADS=8
		./tarea2 1 100 100 $i | grep -o $TIEMPO >> benchmark_D_8th.txt
		let i=i+2 
	done
	i=2
	while [[ $i -le 50 ]]; do
		export OMP_NUM_THREADS=12
		./tarea2 1 100 100 $i | grep -o $TIEMPO >> benchmark_D_12th.txt
		let i=i+2 
	done
	i=2
	let contador=contador+1
done

contador=1
i=1
while [[ $contador -le 3 ]]; do
	#prueba con aumentando la cantidad de grupos M, mantieniendo los demás parámetros y cantidad de threads
	while [[ $i -le 10 ]]; do
		export OMP_NUM_THREADS=1
		./tarea2 $i 100 100 50 | grep -o $TIEMPO >> benchmark_M_1th.txt
		let i=i+1 
	done
	i=1
	while [[ $i -le 10 ]]; do
		export OMP_NUM_THREADS=4
		./tarea2 $i 100 100 50 | grep -o $TIEMPO >> benchmark_M_4th.txt
		let i=i+1 
	done
	i=1
	while [[ $i -le 10 ]]; do
		export OMP_NUM_THREADS=8
		./tarea2 $i 100 100 50 | grep -o $TIEMPO >> benchmark_M_8th.txt
		let i=i+1 
	done
	i=1
	while [[ $i -le 10 ]]; do
		export OMP_NUM_THREADS=12
		./tarea2 $i 100 100 50 | grep -o $TIEMPO >> benchmark_M_12th.txt
		let i=i+1 
	done
	i=1
	let contador=contador+1
done
