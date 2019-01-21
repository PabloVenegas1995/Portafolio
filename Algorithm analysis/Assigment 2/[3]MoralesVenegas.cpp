//Compilar usando g++ -std=c++11

#include <iostream>
#include <climits>
#include "hpc_helpers.hpp"
using namespace std;


class Node{
private:
	int key;
	Node *prev;
	Node *next;
public:
	Node(){}
	void set_key(int x){ key=x; }
	void set_prev(Node *x){ prev=x;}
	void set_next(Node *x){ next=x;}
	int get_key(){return this->key;}
	Node *get_prev(){return this->prev;}
	Node *get_next(){return this->next;}
};

class Doubly_Linked_List{
private:
	Node *top = new Node();
public:
	Doubly_Linked_List(){
		
		top = NULL;
//		top->set_key(MAX);
//		top->set_next(NULL);
//		top->set_prev(NULL);		
	}
	void insert(int x){
		//cout<< "Insertar: " << x <<endl;// <<" top es: "<<top->get_key()<<endl;
		
		Node *newTop = new Node();
		newTop->set_key(x);
		newTop->set_next(NULL);
		newTop->set_prev(top);
		top=newTop;

		//cout<<"newTop es: "<< top->get_key()<<endl;

		while(top->get_prev()!=NULL && x < (top->get_prev())->get_key()){
									
			pop();
			pop();
			newTop->set_key(x);
			newTop->set_next(NULL);
			newTop->set_prev(top);
			top=newTop;
		}
	}

	int pop(){

		if (top == NULL){
			cout<<"UPS, no hay nada en la pila"<<endl;
		}
		else{
			Node *antiguo= new Node();
			antiguo = top;
			int eliminado = antiguo->get_key();
			
			if(top->get_prev()==NULL){top=NULL;delete antiguo;return eliminado;}
			else{
				top = top->get_prev();
				top->set_next(NULL);
				top->set_prev(top->get_prev());
				delete antiguo;
				return eliminado;
			}
		}
	}

	void destroy(){
		if(top==NULL){cout<<"nada que destruir"<<endl;return;}
		else{
			Node *y = top;
			Node *prev = new Node();
//			cout<<" "<<y->get_key()<< " "<<endl;

			while(y!=NULL){
				prev=y->get_prev();
//				cout<<prev->get_key()<< " ";
				prev->set_next(NULL);
				if (prev->get_prev()==NULL){delete y;top=NULL;return;}		
				else{
					prev->set_prev(prev->get_prev());
					delete y;
					y = prev;
				}		
			}
			cout<<endl<<endl;
			top=NULL;
		}
	}

	void print_nodes(){
		if (top == NULL)
		{
			cout<<"No hay nada en la pila"<<endl;
			return;
		}
		else {
			Node *x= new Node();
			x=top;
			cout<<"Los nodos en la pila son: ";
			while(x!=NULL)
			{
				cout<<" " <<x->get_key();
				x=x->get_prev();
			}
		cout<<endl;
		}
	}
};

int main()
{
/*
	Doubly_Linked_List l;
	cout<<"Pila creada"<<endl;
	//l.print_nodes();
	l.insert(1);
	l.print_nodes();
	
//	cout<<"Pila creada1"<<endl;
	
	l.pop();
	
//	cout<<"Pila creada2"<<endl;
	
	l.pop();
//	cout<<"Pila creada3"<<endl;
	l.pop();		
	l.insert(2);
	l.print_nodes();
	l.insert(3);
	l.print_nodes();
	l.insert(4);
	l.print_nodes();
	l.insert(6);
	l.print_nodes();
	l.insert(5);
	l.print_nodes();
	l.insert(7);
	l.print_nodes();
	l.insert(4);
	l.print_nodes();
	cout<<endl<<endl;

	l.pop();
	cout<<"pop realizado a 9 en este caso"<<endl;
	l.print_nodes();

	l.insert(8);
	l.print_nodes();
	cout<<endl;
	l.pop();
	cout<<"pop realizado a 8 en este caso"<<endl;
	l.print_nodes();
	l.pop();
	cout<<"pop realizado a 7 en este caso"<<endl;
	l.print_nodes();
	
	cout<<"Pila Final"<<endl;
	l.print_nodes();
	cout<<"ajsdaslkjdjlasdadas"<<endl<<endl;
	
	cout<<endl;
	cout<<"destroy incoming"<<endl;	
	l.print_nodes();
	l.destroy();
	cout<<"destroy done"<<endl;	

	l.print_nodes();
	l.insert(1);
	l.print_nodes();
//	cout<<endl<<"me lo pitie"<<endl;
	l.pop();
	l.print_nodes();
	l.destroy();

	cout<<"asdf"<<endl<<endl;

*/																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		
// Test para N gigante

	Doubly_Linked_List a;
	TIMERSTART(insertA);
	for (int i = 0; i < 100; i++)
	{
		a.insert(i);
	}
	cout<< "Insertar en la pila A: ";TIMERSTOP(insertA);
	TIMERSTART(worstcaseA);
	a.insert(0);
	cout<< "Peor caso en la pila A: ";TIMERSTOP(worstcaseA);
	for (int i = 0; i < 100; i++)
	{
		a.insert(i);
	}
	TIMERSTART(destroyA);
	a.destroy();
	cout<< "Destroy A: ";TIMERSTOP(destroyA);


	Doubly_Linked_List b;
	TIMERSTART(insertB);
	for (int i = 0; i < 1000; i++)
	{
		b.insert(i);
	}
	cout<< "Insertar en la pila B: ";TIMERSTOP(insertB);
	TIMERSTART(worstcaseB);
	b.insert(0);
	cout<< "Peor caso en la pila B: ";TIMERSTOP(worstcaseB);
	for (int i = 0; i < 1000; i++)
	{
		b.insert(i);
	}
	TIMERSTART(destroyB);
	b.destroy();
	cout<< "Destroy B: ";TIMERSTOP(destroyB);


	Doubly_Linked_List C;
	TIMERSTART(insertC);
	for (int i = 0; i < 10000; i++)
	{
		C.insert(i);
	}
	cout<< "Insertar en la pila C: ";TIMERSTOP(insertC);
	TIMERSTART(worstcaseC);
	C.insert(0);
	cout<< "Peor caso en la pila C: ";TIMERSTOP(worstcaseC);
	for (int i = 0; i < 10000; i++)
	{
		C.insert(i);
	}
	TIMERSTART(destroyC);
	C.destroy();
	cout<< "Destroy C: ";TIMERSTOP(destroyC);

	Doubly_Linked_List D;
	TIMERSTART(insertD);
	for (int i = 0; i < 100000; i++)
	{
		D.insert(i);
	}
	cout<< "Insertar en la pila D: ";TIMERSTOP(insertD);
	TIMERSTART(worstcaseD);
	D.insert(0);
	cout<< "Peor caso en la pila D: ";TIMERSTOP(worstcaseD);
	for (int i = 0; i < 100000; i++)
	{
		D.insert(i);
	}
	TIMERSTART(destroyD);
	D.destroy();
	cout<< "Destroy D: ";TIMERSTOP(destroyD);


	Doubly_Linked_List m;
	TIMERSTART(insertM);
	for (int i = 1; i < 1000000;i++)
	{																																																																																																																																																																																									
		m.insert(i);
	}
	cout<< "Insertar en la pila M: ";TIMERSTOP(insertM);
	TIMERSTART(worstcaseM);
	m.insert(0);
	cout<< "Peor caso en la pila M: ";TIMERSTOP(worstcaseM);
	for (int i = 0; i < 1000000; i++)
	{
		m.insert(i);
	}
	TIMERSTART(destroyM);
	m.destroy();
	cout<< "Destroy M: ";TIMERSTOP(destroyM);

	Doubly_Linked_List E;
	TIMERSTART(insertE);
	for (int i = 0; i < 10000000; i++)
	{
		E.insert(i);
	}
	cout<< "Insertar en la pila E: ";TIMERSTOP(insertE);
	TIMERSTART(worstcaseE);
	E.insert(0);
	cout<< "Peor caso en la pila E: ";TIMERSTOP(worstcaseE);
	for (int i = 0; i < 10000000; i++)
	{
		E.insert(i);
	}
	TIMERSTART(destroyE);
	E.destroy();
	cout<< "Destroy E: ";TIMERSTOP(destroyE);


	Doubly_Linked_List n;
	TIMERSTART(listaN);
	for (int i = 0; i < 100000000; i++)
	{
		n.insert(i);
	}
	cout<< "Insertar en la pila N: ";TIMERSTOP(listaN);
	TIMERSTART(worstcaseN);
	n.insert(0);
	cout<< "Peor caso en la pila N: ";TIMERSTOP(worstcaseN);
	for (int i = 0; i < 100000000; i++)
	{
		n.insert(i);
	}
	TIMERSTART(destroyN);
	n.destroy();
	cout << "Destoy N: ";TIMERSTOP(destroyN); 

	return 0;
}