//
//  Clustering.cpp
//
//
//  Created by Thomas Borgia on 6/13/15.
//
// Name: Richard Levenson
// Course: CSC 415
// Semester: Fall 2015
// Instructor: Dr. Pulimood
// Project Name: Pollution Prediction
// Description: Clustering class which maintains a vector of clusters and handles writing the cluster information to files.
// Filename: Clustering.cpp
// Last Modified On: 11/9/15 by Richard Levenson

#include "Clustering.h"

using namespace std;

string path2 = "/var/www/html/SOAP/app/View/Results/Clusters/";

//----------------------------------------------------------------------------------------------------------
// Clustering object constructor.
//----------------------------------------------------------------------------------------------------------
Clustering::Clustering(vector<Facility> init)
{
	D = init; // A list of all of the facilities available for clustering
}

//----------------------------------------------------------------------------------------------------------
// Density-based spatial clustering of applications with noise
//----------------------------------------------------------------------------------------------------------
void Clustering::DBSCAN(float eps, int MinPts)
{

	vector<Facility*> NeighborPts;  //Holds a vector of pointers to neighboring points

	C = 0; // the initial number of clusters is 0
	/* Loops for all of the facilities */
	for(int i=0; i<D.size(); i++)
	{
		/* Enter the if statement only if the facility has not yet been visited */
		if(!D.at(i).getVisited())
		{
			/* Determine if the facility is nearby any other facilities */
			NeighborPts = regionQuery(D.at(i), eps); // hold the vector of pointers to nighboring facilities in NeighborPts
			D.at(i).setVisited(true); // set that the facility has been visited
			/* Check if there are at least MinPts facilities in this vector of neighboring facilities */
			if(NeighborPts.size() < MinPts)
				noise.push_back(D.at(i));  // If less than MinPts facilities, add it to the list of noise
			else
			{
				/* If more than MinPts facilities, create a new cluster */
				expandCluster(D.at(i), NeighborPts, C, eps, MinPts);
				C++; // increment the number of clusters
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
	/* Loop for all of the pointers in the vector of Facility pointers */
	for(int i=0; i<(NeighborPts.size()); i++)
	{
		vector<Facility*> Neighbor_Pts; // holds neighboring points
		/* Enter the if statement only if the facility has not yet been visited */
		if(!NeighborPts.at(i)->getVisited())
		{
			NeighborPts.at(i)->setVisited(true); // set that the facility has been visited
			/* Determine if the facility pointed to by the pointer is nearby any other facilities */
			Neighbor_Pts = regionQuery(*NeighborPts.at(i), eps);
			/* Check if there are at least MinPts facilities in this vector of neighboring facilities */
			if(Neighbor_Pts.size() >= MinPts)
			{
				/* Loop for all neighboring facilities in local variable Neighbor_Pts */
				for(int j=0; j<Neighbor_Pts.size(); j++)
				{
					bool dupl=false;
					/* Loop for all neighboring facilities in parameter NeighborPts */
					for(int k=0; k<NeighborPts.size(); k++){
						/* Identify if the facility is a duplicate */
						if(Neighbor_Pts.at(j)->getID() == NeighborPts.at(k)->getID())
							dupl=true;
					}
					/* If the facility is not a duplicate, add it to the parameter NeighborPts */
					if(!dupl)
						NeighborPts.push_back(Neighbor_Pts.at(j));
				}
			}
		}
		/* If the facility has not yet been clustered, add it to the cluster */
		if (!NeighborPts.at(i)->getClustered())
		{
			cluster.at(C).push_back(*NeighborPts.at(i)); // add to the cluster
			NeighborPts.at(i)->setClustered(true); // set that the facility has been clustered
		}
	}
}

//----------------------------------------------------------------------------------------------------------
// To check Euclidean distance between two points to determine clusters
//----------------------------------------------------------------------------------------------------------
vector<Facility*> Clustering::regionQuery(Facility P, float eps)
{
	//eps is the longitude/latitude difference threshold for determining if two points are close enough to be considered in the same cluster
	float dist; //distance between two points
	vector<Facility*> localPts; //Holds a vector of pointers to neighboring points
	/* Loops for all of the facilities */
	for(int i=0; i<D.size(); i++)
	{
		/* Calculates the distance between the current facility and the facility P */
		dist = sqrt(pow((P.getLat() - D.at(i).getLat()), 2) + pow((P.getLon() - D.at(i).getLon()), 2));
		if(dist <= eps && dist != 0.0)
		{
			/* If P is within distance eps of the facility, add a pointer to P to the local vector of Facility pointers localPts  */
			localPts.push_back(&D.at(i));
		}
	}
	return localPts; // Returns the vector of pointers to neighboring points
}

//----------------------------------------------------------------------------------------------------------
// Prints locaton information for each cluster to the "index.csv" file
//----------------------------------------------------------------------------------------------------------
void Clustering::printIndex()
{

	ofstream outputFile;
	string outputFileName = path2 + "index.csv"; // Printing to the "index.csv" file
	outputFile.open(outputFileName.c_str()); // Opens the output file
	/* Loops for the total number of clusters */
	for(int i=0; i<C; i++)
	{
		/* Initial minimum and maximum longitudes and latitudes for the cluster */
		double minLat = 90;
		double minLon = 180;
		double maxLat = -90;
		double maxLon = -180;

		/* Loops for the number of facilities in this cluster */
		for(int j=0; j<cluster.at(i).size(); j++)
		{
			/* Updates the minimum and maximum longitudes and latitudes for the cluster based on the locations of the facilities */
			if(cluster.at(i).at(j).getLon() <= minLon)
				minLon = cluster.at(i).at(j).getLon();
			if(cluster.at(i).at(j).getLon() >= maxLon)
				maxLon = cluster.at(i).at(j).getLon();
			if(cluster.at(i).at(j).getLat() <= minLat)
				minLat = cluster.at(i).at(j).getLat();
			if(cluster.at(i).at(j).getLat() >= maxLat)
				maxLat = cluster.at(i).at(j).getLat();
		}
		/* Prints in CSV format the cluster number, minimum latitude, maximum latitude, minimum longitude, and maximum longitude for this cluster */
		outputFile << "cluster-" << to_string(i) << "," << to_string(minLat) << "," << to_string(maxLat) << "," << to_string(minLon) << "," << to_string(maxLon) << endl;
	}
	outputFile.close();
}

//----------------------------------------------------------------------------------------------------------
// To create location data and output to file for Point Analysis Program
//----------------------------------------------------------------------------------------------------------
void Clustering::printLocationInfo()
{
	/* Loops for the total number of clusters */
	for(int i=0; i<C; i++)
	{
		ofstream outputFile;
		string outputFileName = path2 + "Locations/cluster-" + to_string(i) + ".csv"; // Creates a different output file for each cluster in the Locations directory
		outputFile.open(outputFileName.c_str()); // Opens the output file for this cluster
		/* Loops for the number of facilities in this cluster */
		for(int j=0; j<cluster.at(i).size(); j++)
		{
			/* Prints in CSV format the facility ID, facility name, latitude, and longitude for this facility*/
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
	/* Loops for the total number of clusters */
	for(int i=0; i<C; i++)
	{
		ofstream outputFile;
		string outputFileName = path2 + "Contains/cluster-" + to_string(i) + ".csv"; // Creates a different output file for each cluster in the Contains directory
		outputFile.open(outputFileName.c_str()); // Opens the output file for this cluster
		/* Loops for the number of facilities in this cluster */
		for(int j=0; j<cluster.at(i).size(); j++)
		{
			/* Loops for the number of chemicals in this facility */
			for(int k=0; k<cluster.at(i).at(j).getChemCount(); k++)
			{
				/* Prints in CSV format the facility ID, chemical ID,  chemical name, and chemical weight for this chemical*/
				outputFile << cluster.at(i).at(j).getID() << "," << cluster.at(i).at(j).getChemIDAt(k) << "," << cluster.at(i).at(j).getChemNameAt(k) << "," << cluster.at(i).at(j).getChemTAAt(k) << endl;
			}
		}
		outputFile.close();
	}

}
