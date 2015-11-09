//
//  Clustering.h
//  
//
//  Created by Thomas Borgia on 6/13/15.
//
//

#ifndef ____Clustering__
#define ____Clustering__

#include <stdio.h>
#include <stdlib.h>
#include <cmath>
#include <iostream>
#include <fstream>
#include "Facility.h"

#endif /* defined(____Clustering__) */

class Clustering
{
	private:
		int C;
		std::vector<Facility> D;
		std::vector<std::vector<Facility> > cluster;
		std::vector<Facility> noise;

	public:
		Clustering(std::vector<Facility>);
		void DBSCAN(float, int);
		void expandCluster(Facility, std::vector<Facility*>, int, float, int);
		std::vector<Facility*> regionQuery(Facility, float);
		void printIndex();
		void printLocationInfo();
		void printContainsInfo();
};
