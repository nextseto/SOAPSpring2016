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
	chemicalID = cID;
	chemicalName = cName;
	total_amount = tamt;
}

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
