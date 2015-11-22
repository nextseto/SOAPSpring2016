// Name: Created by Thomas Borgia on 5/19/15

// Name: Zachary Nelson
// Course: CSC 415
// Semester: Fall 2015
// Instructor: Dr. Pulimood
// Project Name: Pollution Prognosticators
// Description: Read data in from facilities.csv and contains.csv and use the clustering
// algorithm on this data.
// Filename: UpdateClusters.cpp
// Last Modified On: 11/9/15

#include <stdio.h>
#include <iostream>
#include <iomanip>
#include <fstream>
#include <sstream>
#include <cstring>
#include <algorithm>
#include "Facility.h"
#include "Clustering.h"

using namespace std;

vector<Facility> facilitiesList; // create a vector of Facility objects

// Set path for input files needed for clustering
string path = "/var/www/html/SOAP/app/View/Results/src/";

int facilitiesCount=0; // initialize the facility counter to 0

// String to double
double sTOd(string str)
{
	stringstream ss(str);
	double ret;
	ss >> ret;
	return ret;
}


int main()
{
	ifstream inFile1; // create input stream
	string inFile1name = path +"facilities.csv"; // create file name from path
	inFile1.open(inFile1name.c_str()); // open the file

	//Add Location Data to Program
	while(!inFile1.eof()) // when the end of the file has not been reached
	{
		string facilityInfo; // create the facility info string
		vector<string> temp; // create the vector of temporary strings
		getline(inFile1, facilityInfo, '\r'); // read line

		istringstream ss(facilityInfo); // create string stream
		while (ss) // while there are still strings to be read
		{
			string s; // create string variable
			if (!getline(ss, s, ',')) break; // if the end of the line has be reached
			temp.push_back(s); // put line into temporary vector
		}
		// add the data stored in the temp vector to facilitiesList
		facilitiesList.push_back(Facility(temp[0], temp[1], sTOd(temp[2]), sTOd(temp[3])));
		temp.clear(); // clear vector
	}

	inFile1.close(); // close facilities.csv 
	ifstream inFile2; // create new input stream

	const char chars[] = "Pounds Grams"; // used for measurement of pollutant

	string inFile2name = path + "contains.csv"; // create file name from path
	inFile2.open(inFile2name.c_str()); // open the file
	while(!inFile2.eof()) // when the end of the file has not been reached
	{
		string containsInfo; // create the string about what pollutants a facility has
		vector<string> temp; // create the vector of temporary strings
		getline(inFile2, containsInfo, '\r'); // read line

		istringstream ss(containsInfo); // create string stream

		while(ss) // while there are still strings to be read
		{
			string s; // create string variable
			if (!getline(ss, s, ',')) break; // if the end of the line has be reached
			temp.push_back(s); // put line into temporary vector
		}

        // Removes suffix from pollutant data
		for(unsigned int i=0; i<strlen(chars); ++i)
		{
			temp[3].erase(remove(temp[3].begin(), temp[3].end(), chars[i]), temp[3].end());
		}

		// add the data stored in the temp vector to facilitiesList
		for(int i=0; i<facilitiesList.size(); i++)
		{
			if(facilitiesList.at(i).getID() == temp[0])
			{
				facilitiesList.at(i).addChemical(Chemical(temp[1], temp[2], stoi(temp[3])));
			}
		}
	}

	inFile2.close(); // close contains.csv

	Clustering clustering(facilitiesList); // create cluster using facilitesList
	float eps = 0.01; // define eps 
	int minPts = 3; // minimum number of points

	clustering.DBSCAN(eps, minPts); // density-based spatial clustering of applications with noise
	clustering.printIndex(); // display index 
	clustering.printLocationInfo(); // display location info
	clustering.printContainsInfo(); // display pollutant info
}
