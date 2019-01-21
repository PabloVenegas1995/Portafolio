#include <iostream>
#include <stdio.h>
#include <random>
#include <algorithm>
#include <string>
#include <unordered_map>
//#include "hpc_helpers.hpp"

using namespace std;

unordered_map<string, int> mapa;

int minParticion(vector <int> Monedas, int cantidadMonedas, int Suma1, int Suma2)
{
  if (cantidadMonedas < 0){return abs(Suma1 - Suma2);}

  string distanciaMin = to_string(cantidadMonedas) + "|" + to_string(Suma1);

  if (mapa.find(distanciaMin) == mapa.end())
  {
    int inc = minParticion(Monedas, cantidadMonedas - 1, Suma1 + Monedas[cantidadMonedas], Suma2);

    int exc = minParticion(Monedas, cantidadMonedas - 1, Suma1, Suma2 + Monedas[cantidadMonedas]);

    mapa[distanciaMin] = min (inc, exc);
  }
  return mapa[distanciaMin];
}

int main(int argc, char const *argv[])
{
	
  int M = atoi(argv[1]);
  if (M <= 1 || M >= 1000)
  { 
    cout << "Nada que hacer aqui, compilacion terminada por valor de M fuera de los limites 1 < M < 1000"<<endl;
    return 0;
  }

	vector <int> monedas;

	random_device rd; 
  mt19937 eng(rd());
  uniform_int_distribution<> distr(1, 1000); 
  
  for(int i=0; i<M; ++i) monedas.push_back(distr(eng)); 

//  sort(monedas.begin(),monedas.end());
/*
	for (int i = 0; i < M ; i++){
		cout << monedas[i] << " ";
	}
	cout << endl;
*/
	int minDiferencia = 0;
//  TIMERSTART(minimo)
	minDiferencia = minParticion(monedas, M-1, 0, 0);
//  TIMERSTOP(minimo)
  cout << "La diferencia minima es: " << minDiferencia<<endl;

	return 0;
}