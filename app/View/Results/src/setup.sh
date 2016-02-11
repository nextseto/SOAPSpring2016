bpath="/var/www/html/SOAP/app/View/Results/";
spath="/var/www/html/SOAP/app/View/Results/src";
opath="/var/www/html/SOAP/app/View/Results/Clusters/";

mkdir -p $bpath/Clusters
mkdir -p $opath/Contains
mkdir -p $opath/Locations

g++ -std=c++11 $spath/PointAnalysis.cpp $spath/Chemical.cpp $spath/Facility.cpp -o $opath/pta.exe
g++ -std=c++11 $spath/UpdateClusters.cpp $spath/Clustering.cpp $spath/Chemical.cpp $spath/Facility.cpp -o $opath/upc.exe

$opath/upc.exe;

