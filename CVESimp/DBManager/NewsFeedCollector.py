## downloading feeds

################
#              #
#   librarys   #
#              #
################
import re

from xml.dom import minidom
import urllib
import simplifier
import database_stuff
import time
import dateutil
import dateutil.parser

####################
#                  #
#  Database Stuff  #
#                  #
####################

database = database_stuff.t_database("localhost", "root", "", "elderbase")

####################
#                  #
#       CVE        #
#                  #
####################

# get feeds
CVE_Feed = urllib.urlopen('http://nvd.nist.gov/download/nvd-rss.xml')

# format

CVE_Feed = minidom.parse(CVE_Feed)
title = CVE_Feed.getElementsByTagName('title')
link = CVE_Feed.getElementsByTagName('link')
description = CVE_Feed.getElementsByTagName('description')
dater = CVE_Feed.getElementsByTagName('dc:date')

for index in range(0, len(dater)-1):
	pl = dater[index].toxml()
	pl = re.sub('\<[^>]+\>', '', pl)
	pl = re.sub('[A-Z]', ' ', pl)
	pl = pl[:-1]
	simplified = simplifier.simplify(str(description[index+1].toxml()))
	database.add_article(title[index+1].toxml(), link[index+1].toxml(), simplified, pl, simplifier.tagify(simplified))
	
database.commit()
