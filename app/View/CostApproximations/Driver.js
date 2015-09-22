function createObjects("info.txt")
{
	success: function(file)
	{
                var lines = file.split('\n');
                
                for(int i = 0; i < lines.length(); i++)
                {
                	var siteInfo = lines.split('*');
                	
                	var siteName = siteInfo[0];
                	var siteAddress = siteInfo[1];
                	var siteCounty = siteInfo[2];
                	var siteSize = siteInfo[3];
                
                document.write(siteName + siteAddress + siteCounty + siteSize);
                }
	}
}
