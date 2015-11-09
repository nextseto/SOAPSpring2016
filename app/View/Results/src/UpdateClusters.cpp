//
//  UpdateClusters.cpp
//
//
//  Created by Thomas Borgia on 5/19/15.
//
//

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

vector<Facility> facilitiesList;

// Set path for input files needed for clustering
string path = "/var/www/html/SOAP/app/View/Results/src/";

int facilitiesCount=0;

double sTOd(string str)
{
	stringstream ss(str);
	double ret;
	ss >> ret;
	return ret;
}

int main()
{
	ifstream inFile1;
	string inFile1name = path +"facilities.csv";
	inFile1.open(inFile1name.c_str());

	//Add Location Data to Program
	while(!inFile1.eof())
	{
		string facilityInfo;
		vector<string> temp;
		getline(inFile1, facilityInfo, '\r');

		istringstream ss(facilityInfo);

		while (ss)
		{
			string s;
			if (!getline(ss, s, ',')) break;
			temp.push_back(s);
		}
		facilitiesList.push_back(Facility(temp[0], temp[1], sTOd(temp[2]), sTOd(temp[3])));

		temp.clear();
	}

	inFile1.close();
	ifstream inFile2;

	const char chars[] = "Pounds Grams";

	string inFile2name = path + "contains.csv";
	inFile2.open(inFile2name.c_str());
	while(!inFile2.eof())
	{
		string containsInfo;
		vector<string> temp;
		getline(inFile2, containsInfo, '\r');

		istringstream ss(containsInfo);

		while(ss)
		{
			string s;
			if (!getline(ss, s, ',')) break;
			temp.push_back(s);
		}

        // Removes total amount suffix
		for(unsigned int i=0; i<strlen(chars); ++i)
		{
			temp[3].erase(remove(temp[3].begin(), temp[3].end(), chars[i]), temp[3].end());
		}

		for(int i=0; i<facilitiesList.size(); i++)
		{
			if(facilitiesList.at(i).getID() == temp[0])
			{
				facilitiesList.at(i).addChemical(Chemical(temp[1], temp[2], stoi(temp[3])));
			}
		}
	}

	inFile2.close();

	Clustering clustering(facilitiesList);
	float eps = 0.01;
	int minPts = 3;

	clustering.DBSCAN(eps, minPts);
	clustering.printIndex();
	clustering.printLocationInfo();
	clustering.printContainsInfo();

}
