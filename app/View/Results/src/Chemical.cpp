//
//  Chemical.cpp
//
//
//  Created by Thomas Borgia on 6/13/15.
//
//

#include "Chemical.h"

using namespace std;

Chemical::Chemical(string cID, string cName, int tamt)
{
	chemicalID = cID; // Chemical ID
	chemicalName = cName; // Chemical Name
	total_amount = tamt;  // Total Amount
}

// The following three methods are getters for the three attributes

string Chemical::getChemName()
{
	return chemicalName;
}

string Chemical::getChemID()
{
	return chemicalID;
}

int Chemical::getTA()
{
	return total_amount;
}
