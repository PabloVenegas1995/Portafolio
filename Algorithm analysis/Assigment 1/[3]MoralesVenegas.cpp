#include <bits/stdc++.h>
using namespace std;
int k;
vector <vector <int> > arbol;
vector <int> distancia;
int marcar(int nodo,int recorrido){
	int aux,guardar = recorrido;
	for(int i = 0; i < arbol[nodo].size();i++){
		aux = marcar(arbol[nodo][i],recorrido+1);
		if(aux > guardar) guardar = aux;
	}
	if(guardar > distancia[nodo])distancia[nodo] = guardar;
	return guardar;
}

int main(){
	int n,aux,aux2;
	scanf("%d %d",&n,&k);
	arbol.resize(n,vector<int>());
	distancia.resize(n,-1);
	for(int i = 0; i < n-1; i++){
		scanf("%d %d",&aux,&aux2);
		arbol[aux].push_back(aux2);
	}
	distancia[0] = marcar(0,1);
	vector <int> eliminados;
	//for(int i = 0; i < distancia.size();i++)printf("%d %d\n",i,distancia[i]);
	for(int i = 0; i < distancia.size();i++)if(distancia[i] < k)eliminados.push_back(i);
	for(int i = 0; i < arbol.size();i++){
		for(int j = 0; j < arbol[i].size();j++){
			if(distancia[arbol[i][j]] < k){
				arbol[i].erase(arbol[i].begin()+j);
				j--;
			}
		}
	}
	/*for(int i = 0; i < arbol.size();i++){
		if(distancia[i] < k){
			arbol.erase(arbol.begin()+i);
			i--;
		}
	}*/
	for(int i = 0; i < arbol.size();i++){
		for(int j = 0; j < arbol[i].size();j++){
			printf("nodo %d nodo %d\n",i,arbol[i][j]);
		}
	}
	return 0;
}

/*
23 5
0 1
0 2
1 3
1 4
3 7
3 10
7 8
8 9
4 11
11 12
12 13
12 14
14 15
2 5
2 6
5 16
6 17
6 18
17 19
17 20
19 21
19 22

*/