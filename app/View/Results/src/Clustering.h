//
//  Clustering.h
//  
//
//  Created by Thomas Borgia on 6/13/15.
//
// Name: Richard Levenson
// Course: CSC 415
// Semester: Fall 2015
// Instructor: Dr. Pulimood
// Project Name: Pollution Prediction
// Description: D\Header file to define the Clustering class.
// Filename: Clustering.h
// Last Modified On: 11/9/15 by Richard Levenson

/* Preprocessor Directives */
#ifndef ____Clustering__ //Run other preprocessor directives only if ____Clustering__ has not already been defined
#define ____Clustering__ //Define the ___Clustering__ macro
/* Include cpp header files */
#include <stdio.h>
#include <stdlib.h>
#include <cmath>
#include <iostream>
#include <fstream>
#include "Facility.h"

#endif /* defined(____Clustering__) */
/* Clutering class header file*/
class Clustering
{
	private:
		int C; //number of clusters
		std::vector<Facility> D; // vector of all of the facilities
		std::vector<std::vector<Facility> > cluster; //vector of all of the clusters
		std::vector<Facility> noise; //vector of facilities representing "noise"

	public:
		Clustering(std::vector<Facility>); // Clustering object constructor
		void DBSCAN(float, int); // Density - based spatial clustering of applications with noise
		void expandCluster(Facility, std::vector<Facility*>, int, float, int); // When point's neighborhood is too small, add to exisiting nearby cluster
		std::vector<Facility*> regionQuery(Facility, float);// To check Euclidean distance between two points to determine clusters
		void printIndex(); // Prints locaton information for each cluster to the "index.csv" file
		void printLocationInfo(); // To create location data and output to file for Point Analysis Program
		void printContainsInfo(); // To create location data and output to file for Point Analysis Program
};
