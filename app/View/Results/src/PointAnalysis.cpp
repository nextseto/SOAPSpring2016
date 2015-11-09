//
//  PointAnalysis.cpp
//
//
//  Created by Thomas Borgia on 6/14/15.
//
//

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

double sTOd(string str)
{
	stringstream ss(str);
	double ret;
	ss >> ret;
	return ret;
}

//----------------------------------------------------------------------------------------------------------
// To output useable data to front-end SOAP website
//----------------------------------------------------------------------------------------------------------
void printInfo(Facility query, bool dataFlag)
{
	if(dataFlag)
	{
		for(int i=0; i<query.getChemCount(); i++)
		{
			cout << query.getChemIDAt(i) << endl;
			cout << query.getChemNameAt(i) << endl;
			cout << query.getChemTAAt(i) << endl;
		}
		cout << query.getChemCount();
	}
	else if(!dataFlag)
	{
		cout << "No estimated chemicals at this location" << endl;
		cout << "N/A" << endl;
		cout << "N/A" << endl;
		cout << "0" << endl;
	}
}

int main(int argc, char *argv[], char *envp[])
{
	ifstream inFile1;
	string clusterFileName;
	vector<Facility> cluster;
	string inFile1name = path + "index.csv";
	inFile1.open(inFile1name.c_str());
	Facility query = Facility("QUERY", "QUERY", sTOd(argv[1]), sTOd(argv[2]));
	bool eflag = false;

	while(inFile1.peek() != EOF && !eflag)
	{
		string clusterInfo;
		string temp[5];
		getline(inFile1, clusterInfo, '\n');

		istringstream ss(clusterInfo);
		for(int i=0; i<5; i++)
		{
			getline(ss, temp[i], ',');
		}

        // If query point is within range of a cluster, use the cluster files that pertain to that point
		if(sTOd(temp[1]) <= sTOd(argv[1]) && sTOd(temp[2]) >= sTOd(argv[1]) && sTOd(temp[3]) <= sTOd(argv[2]) && sTOd(temp[4]) >= sTOd(argv[2]))
		{
			eflag = true;
			clusterFileName = temp[0] + ".csv";
			ifstream inFile2;
			string inFile2name = path + "Locations/" + clusterFileName;
			inFile2.open(inFile2name.c_str());
			while(inFile2.peek() != EOF)
			{
				string facilityInfo;
				string temp[4];
				getline(inFile2, facilityInfo, '\n');
				istringstream ss(facilityInfo);

				for(int i=0; i<4; i++)
				{
					getline(ss, temp[i], ',');
				}

				cluster.push_back(Facility(temp[0], temp[1], sTOd(temp[2]), sTOd(temp[3])));
			}
		}
	}
	if(eflag)
	{
		ifstream inFile3;
		string inFile3name = path + "Contains/" + clusterFileName;
		inFile3.open(inFile3name.c_str());
		while(inFile3.peek() != EOF)
		{
			int count = 0;
			string containsInfo;
			string temp[4];
			getline(inFile3, containsInfo, '\n');
			istringstream ss(containsInfo);

			for(int i=0; i<4; i++)
			{
				getline(ss, temp[i], ',');
			}

			istringstream ss1(temp[3]);
			ss1 >> temp[3];

			for(int i=0; i<cluster.size(); i++)
			{
				if(temp[0] == cluster[i].getID())
				{
					Chemical chem = Chemical(temp[1], temp[2], atoi(temp[3].c_str()));
					cluster[i].addChemical(chem);
				}
			}
		}

		vector<float> dist;
		for(int i=0; i<cluster.size(); i++)
		{

			dist.push_back(sqrt(pow((sTOd(argv[1]) - cluster.at(i).getLat()), 2) + pow((sTOd(argv[2]) - cluster.at(i).getLon()), 2)));

			int chemicalCount = cluster.at(i).getChemCount();
			for(int j=0; j<chemicalCount; j++)
			{
				string chemID = cluster.at(i).getChemIDAt(j);
				string chemName = cluster.at(i).getChemNameAt(j);
				double chemTA = cluster.at(i).getChemTAAt(j);
				double queryChemTA = ((1-dist[i])*chemTA);
				if(queryChemTA >= 1)
					query.addChemical(Chemical(chemID, chemName, queryChemTA));
			}
		}
	}
	printInfo(query, eflag);
}
