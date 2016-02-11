//
//  Chemical.h
//
//
//  Created by Thomas Borgia on 6/13/15.
//
//

#ifndef ____Chemical__
#define ____Chemical__

#include <stdio.h>
#include <string>

class Chemical
{
	private:
		std::string chemicalID, chemicalName;
		int total_amount;

	public:
		Chemical(std::string, std::string, int);
		std::string getChemName();
		std::string getChemID();
		int getTA();
};

#endif /* defined(____Chemical__) */
