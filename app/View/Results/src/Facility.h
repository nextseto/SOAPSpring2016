//
//  Facility.h
//  
//
//  Created by Thomas Borgia on 5/18/15.
//
//

#ifndef ____Facility__
#define ____Facility__

#include <stdio.h>
#include <vector>
#include "Chemical.h"

class Facility
{
	private:
		std::string fid, name;
		double latitude, longitude;
		bool visited, clustered;
		int chemicalCount;
		std::vector<Chemical> chemicals;

	public:
		Facility(std::string, std::string, double, double);
		void addChemical(Chemical);
		void setVisited(bool);
		void setClustered(bool);
		std::string getID();
		std::string getName();
		double getLat();
		double getLon();
		int getChemCount();
		std::string getChemNameAt(int);
		std::string getChemIDAt(int);
		double getChemTAAt(int);
		bool getVisited();
		bool getClustered();

};


#endif /* defined(____Facility__) */
