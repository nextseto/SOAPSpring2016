//
//  Clustering.cpp
//
//
//  Created by Thomas Borgia on 6/13/15.
//
//

#include "Clustering.h"

using namespace std;

string path2 = "/var/www/html/SOAP/app/View/Results/Clusters/";

Clustering::Clustering(vector<Facility> init)
{
	D = init;
}

//----------------------------------------------------------------------------------------------------------
// Density-based spatial clustering of applications with noise
//----------------------------------------------------------------------------------------------------------
void Clustering::DBSCAN(float eps, int MinPts)
{

	vector<Facility*> NeighborPts;

	C = 0;

	for(int i=0; i<D.size(); i++)
	{
		if(!D.at(i).getVisited())
		{
			NeighborPts = regionQuery(D.at(i), eps);
			D.at(i).setVisited(true);
			if(NeighborPts.size() < MinPts)
				noise.push_back(D.at(i));
			else
			{
				expandCluster(D.at(i), NeighborPts, C, eps, MinPts);
				C++;
			}
		}
	}
}

//----------------------------------------------------------------------------------------------------------
// When point's neighborhood is too small, add to exisiting nearby cluster
//----------------------------------------------------------------------------------------------------------
void Clustering::expandCluster(Facility P, vector<Facility*> NeighborPts, int C, float eps, int MinPts)
{
	vector<Facility> init;
	cluster.push_back(init);

	for(int i=0; i<(NeighborPts.size()); i++)
	{
		vector<Facility*> Neighbor_Pts;

		if(!NeighborPts.at(i)->getVisited())
		{
			NeighborPts.at(i)->setVisited(true);
			Neighbor_Pts = regionQuery(*NeighborPts.at(i), eps);
			if(Neighbor_Pts.size() >= MinPts)
			{
				for(int j=0; j<Neighbor_Pts.size(); j++)
				{
					bool dupl=false;

					for(int k=0; k<NeighborPts.size(); k++){
						if(Neighbor_Pts.at(j)->getID() == NeighborPts.at(k)->getID())
							dupl=true;
					}
					if(!dupl)
						NeighborPts.push_back(Neighbor_Pts.at(j));
				}
			}
		}

		if (!NeighborPts.at(i)->getClustered())
		{
			cluster.at(C).push_back(*NeighborPts.at(i));
			NeighborPts.at(i)->setClustered(true);
		}
	}
}

//----------------------------------------------------------------------------------------------------------
// To check Euclidean distance between two points to determine clusters
//----------------------------------------------------------------------------------------------------------
vector<Facility*> Clustering::regionQuery(Facility P, float eps)
{
	float dist;
	vector<Facility*> localPts;
	for(int i=0; i<D.size(); i++)
	{
		dist = sqrt(pow((P.getLat() - D.at(i).getLat()), 2) + pow((P.getLon() - D.at(i).getLon()), 2));
		if(dist <= eps && dist != 0.0)
		{
			localPts.push_back(&D.at(i));
		}
	}
	return localPts;
}

void Clustering::printIndex()
{

	ofstream outputFile;
	string outputFileName = path2 + "index.csv";
	outputFile.open(outputFileName.c_str());

	for(int i=0; i<C; i++)
	{

		double minLat = 90;
		double minLon = 180;
		double maxLat = -90;
		double maxLon = -180;


		for(int j=0; j<cluster.at(i).size(); j++)
		{
			if(cluster.at(i).at(j).getLon() <= minLon)
				minLon = cluster.at(i).at(j).getLon();
			if(cluster.at(i).at(j).getLon() >= maxLon)
				maxLon = cluster.at(i).at(j).getLon();
			if(cluster.at(i).at(j).getLat() <= minLat)
				minLat = cluster.at(i).at(j).getLat();
			if(cluster.at(i).at(j).getLat() >= maxLat)
				maxLat = cluster.at(i).at(j).getLat();
		}

		outputFile << "cluster-" << to_string(i) << "," << to_string(minLat) << "," << to_string(maxLat) << "," << to_string(minLon) << "," << to_string(maxLon) << endl;
	}
	outputFile.close();
}

//----------------------------------------------------------------------------------------------------------
// To create location data and output to file for Point Analysis Program
//----------------------------------------------------------------------------------------------------------
void Clustering::printLocationInfo()
{
	for(int i=0; i<C; i++)
	{
		ofstream outputFile;
		string outputFileName = path2 + "Locations/cluster-" + to_string(i) + ".csv";
		outputFile.open(outputFileName.c_str());

		for(int j=0; j<cluster.at(i).size(); j++)
		{
			outputFile << cluster.at(i).at(j).getID() << "," << cluster.at(i).at(j).getName() << "," << cluster.at(i).at(j).getLat() << "," << cluster.at(i).at(j).getLon() << endl;
		}
		outputFile.close();
	}
}

//----------------------------------------------------------------------------------------------------------
// To create location data and output to file for Point Analysis Program
//----------------------------------------------------------------------------------------------------------
void Clustering::printContainsInfo()
{
	for(int i=0; i<C; i++)
	{
		ofstream outputFile;
		string outputFileName = path2 + "Contains/cluster-" + to_string(i) + ".csv";
		outputFile.open(outputFileName.c_str());

		for(int j=0; j<cluster.at(i).size(); j++)
		{
			for(int k=0; k<cluster.at(i).at(j).getChemCount(); k++)
			{
				outputFile << cluster.at(i).at(j).getID() << "," << cluster.at(i).at(j).getChemIDAt(k) << "," << cluster.at(i).at(j).getChemNameAt(k) << "," << cluster.at(i).at(j).getChemTAAt(k) << endl;
			}
		}
		outputFile.close();
	}

}
