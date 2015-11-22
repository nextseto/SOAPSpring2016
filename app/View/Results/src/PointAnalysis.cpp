//  Created by Thomas Borgia on 6/14/15.

// Name: Evan Melquist, Zachary Nelson, Richard Levenson, Jeremy Leon and Hunter Dubel
// Course: CSC 415
// Semester: Fall 2015
// Instructor: Dr. Pulimood
// Project Name: Pollution Prediction
// Description: Takes a latitude and a longitude point and finds what cluster it belongs
// to. If it finds a cluster, all the chemicals for that cluster are accessed and pollution
// prediction information is displayed. 
// Filename: PointAnalysis.cpp
// Last Modified On: 11/10/15

#include <stdio.h>
#include <iostream>
#include <iomanip>
#include <fstream>
#include <sstream>
#include <cmath>
#include "Facility.h"

using namespace std;

// Set path for input files needed for analysis
string path = "/var/www/html/SOAP/app/View/Results/Clusters/";

// string to double
double sTOd(string str)
{
	stringstream ss(str);
	double ret;
	ss >> ret;
	return ret;
}

//----------------------------------------------------------------------------------------------------------
// To output usable data to front-end SOAP website
//----------------------------------------------------------------------------------------------------------
void printInfo(Facility query, bool dataFlag)
{
	if(dataFlag) // when there is estimated data to be displayed
	{
		for(int i=0; i<query.getChemCount(); i++) // prints data for each of the estimated chemicals
		{
			cout << query.getChemIDAt(i) << endl;
			cout << query.getChemNameAt(i) << endl;
			cout << query.getChemTAAt(i) << endl;
		}
		cout << query.getChemCount(); 
	}
	else if(!dataFlag) // if there is not estimated data to be displayed, display this instead
	{
		cout << "No estimated chemicals at this location" << endl;
		cout << "N/A" << endl;
		cout << "N/A" << endl;
		cout << "0" << endl;
	}
}

int main(int argc, char *argv[], char *envp[])
{
	ifstream inFile1;                        // create input stream 
	string clusterFileName;                  // name for the cluster file
	vector<Facility> cluster;                // vector of Facility objects = cluster
	string inFile1name = path + "index.csv"; // name of the file that holds the cluster locations
	inFile1.open(inFile1name.c_str());       // open the file
	Facility query = Facility("QUERY", "QUERY", sTOd(argv[1]), sTOd(argv[2])); // created a Facility from the lat and long inputs
	bool eflag = false;                      // end flag to stop analysis

	while(inFile1.peek() != EOF && !eflag)   // when the end of the file has not been reached and there is no end flag
	{
		string clusterInfo;                  // row without separation
		string temp[5];                      // holds the five columns for each row of index.csv
		getline(inFile1, clusterInfo, '\n'); // assign clusterInfo data
		istringstream ss(clusterInfo);       // creates a stream for that row

		for(int i=0; i<5; i++)               
		{
			getline(ss, temp[i], ',');       // separates row into 5 different parts 
		}

        // If query point is within range of a cluster, use the cluster files that pertain to that point
		if(sTOd(temp[1]) <= sTOd(argv[1]) && sTOd(temp[2]) >= sTOd(argv[1]) && sTOd(temp[3]) <= sTOd(argv[2]) && sTOd(temp[4]) >= sTOd(argv[2]))
		{
			eflag = true;                              // set the end flag to true because a cluster has been found
			clusterFileName = temp[0] + ".csv";        // create a file for that cluster
			ifstream inFile2;						   // create another input stream
			string inFile2name = path + "Locations/" + clusterFileName; // full path for cluster file
			inFile2.open(inFile2name.c_str());         // open this file
			while(inFile2.peek() != EOF)               // when the end of the file has not been reached
			{
				string facilityInfo;                   // row without separation
				string temp[4];                        // holds the four columns for each row
				getline(inFile2, facilityInfo, '\n');  // assign facilityInfo data
				istringstream ss(facilityInfo);        // creates a stream for that row

				for(int i=0; i<4; i++)
				{
					getline(ss, temp[i], ',');		   // separates row into 4 different parts
				}

				cluster.push_back(Facility(temp[0], temp[1], sTOd(temp[2]), sTOd(temp[3]))); // add Facility to the cluster
			}
		}
	}
	if(eflag) // if the analysis is done
	{
		ifstream inFile3;                         // create a new input stream 
		string inFile3name = path + "Contains/" + clusterFileName; // file name to open
		inFile3.open(inFile3name.c_str());        // open file
		while(inFile3.peek() != EOF)              // when the end of the file has not been reached
		{
			int count = 0;                        // counter
			string containsInfo;                  // row without separation
			string temp[4];						  // holds the four columns for each row
			getline(inFile3, containsInfo, '\n'); // assign containsInfo data from the row in the file
			istringstream ss(containsInfo);       // creates a stream for that row

			for(int i=0; i<4; i++)
			{
				getline(ss, temp[i], ',');        // separates row into 4 different parts
			}

			istringstream ss1(temp[3]);           // creates a stream of the string representation of the amount of the chemical
			ss1 >> temp[3];						  // ? 

			for(int i=0; i<cluster.size(); i++)	  // loops for all of the facilities in the cluster
			{
				if(temp[0] == cluster[i].getID()) // if the ID of the facility matches the facility ID of this row, create a chemical with this 
					                              // information and add it to that facility
				{
					Chemical chem = Chemical(temp[1], temp[2], atoi(temp[3].c_str()));
					cluster[i].addChemical(chem);
				}
			}
		}

		vector<float> dist;						  // holds the distance between the latitude and longitude of the point and each of the facilities in the cluster
		for(int i=0; i<cluster.size(); i++)		  // loops for all facilities in the cluster
		{

			dist.push_back(sqrt(pow((sTOd(argv[1]) - cluster.at(i).getLat()), 2) + pow((sTOd(argv[2]) - cluster.at(i).getLon()), 2))); //calculates the distance

			int chemicalCount = cluster.at(i).getChemCount();	//gets the number of chemicals at the facility
			for(int j=0; j<chemicalCount; j++)				 	// loops for all chemicals at the facility
			{
				string chemID = cluster.at(i).getChemIDAt(j);	// gets all data about the chemical
				string chemName = cluster.at(i).getChemNameAt(j);
				double chemTA = cluster.at(i).getChemTAAt(j);
				double queryChemTA = ((1-dist[i])*chemTA);
				if(queryChemTA >= 1)
					query.addChemical(Chemical(chemID, chemName, queryChemTA)); // adds the chemical to the temporary facility that represents the input point
			}
		}
	}
	printInfo(query, eflag); 					 // prints all estimated chemicals
}
