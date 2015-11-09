//
//  Facility.cpp
//  
//
//  Created by Thomas Borgia on 5/18/15.
//
//

#include "Facility.h"

using namespace std;

//----------------------------------------------------------------------------------------------------------
// To create new instance of Facility object
//----------------------------------------------------------------------------------------------------------
Facility::Facility(string facilityID, string facilityName, double lat, double lon)
{
	chemicalCount = 0;
	fid = facilityID;
	name = facilityName;
	latitude = lat;
	longitude = lon;
	visited = false;
}

//----------------------------------------------------------------------------------------------------------
// To add a Chemical object to this Facility object
//----------------------------------------------------------------------------------------------------------
void Facility::addChemical(Chemical chem)
{
	chemicals.push_back(chem);
	chemicalCount++;
}

//----------------------------------------------------------------------------------------------------------
// To set a flag that this Facility object has been visited by the clustering algorithm
//----------------------------------------------------------------------------------------------------------
void Facility::setVisited(bool val)
{
	visited = val;
}

//----------------------------------------------------------------------------------------------------------
// To set a flag that this Facility object has been put into a cluster group by the clustering algorithm
//----------------------------------------------------------------------------------------------------------
void Facility::setClustered(bool val)
{
	clustered = val;
}

string Facility::getID()
{
	return fid;
}

string Facility::getName()
{
	return name;
}

double Facility::getLat()
{
	return latitude;
}

double Facility::getLon()
{
	return longitude;
}

int Facility::getChemCount()
{
	return chemicalCount;
}

string Facility::getChemNameAt(int i)
{
	return chemicals.at(i).getChemName();
}

string Facility::getChemIDAt(int i)
{
	return chemicals.at(i).getChemID();
}

double Facility::getChemTAAt(int i)
{
	return chemicals.at(i).getTA();
}

bool Facility::getVisited()
{
	return visited;
}

bool Facility::getClustered()
{
	return clustered;
}
