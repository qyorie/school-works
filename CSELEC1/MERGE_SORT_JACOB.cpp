/*===========================================================*/
/* Filename: MERGE_SORT_JACOB.cpp                            */
/* Name: Troy Tristan Jacob                                  */
/* Course/Year/Section: BSCS-3A                              */
/* Description: This program implements the Merge            */
/*       Sort algorithm to sort an array of random integers. */
/*===========================================================*/
#include <iostream>
#include <vector>
using namespace std;

//function to merge two halves
void merge(vector<int>& arr, int left, int mid, int right){        
    int n1 = mid - left + 1;
    int n2 = right - mid;

    vector<int> L(n1), R(n2);

    for (int i = 0; i < n1; i++)
        L[i] = arr[left + i];
    for (int j = 0; j < n2; j++)
        R[j] = arr[mid + 1 + j];

    int i = 0, j = 0;
    int k = left;

    while (i < n1 && j < n2) {
        if (L[i] <= R[j]) {
            arr[k] = L[i];
            i++;
        }
        else {
            arr[k] = R[j];
            j++;
        }
        k++;
    }
    while (i < n1) {
        arr[k] = L[i];
        i++;
        k++;
    }

    while (j < n2) {
        arr[k] = R[j];
        j++;
        k++;
    }
}
//recursive merge sort function
void mergeSort(vector<int>& arr, int left, int right){
    
    if (left >= right)
        return;

    int mid = left + (right - left) / 2;
    mergeSort(arr, left, mid);
    mergeSort(arr, mid + 1, right);
    merge(arr, left, mid, right);
}
//main function
int main(){
    
    vector<int> arr;
    int n = 5;

    //generate random numbers
    for(int i = 0; i < n; i++){
        arr.push_back(rand() % 100);
    }
    //print unsorted array
    cout << "Unsorted array: ";
    for (int i = 0; i < arr.size(); i++)
        cout << arr[i] << " ";
    cout << endl;

    mergeSort(arr, 0, n - 1); //sort the array
    //print sorted array
    cout << "Sorted array: ";
    for (int i = 0; i < arr.size(); i++)
        cout << arr[i] << " ";
    cout << endl;
    
    return 0;
}