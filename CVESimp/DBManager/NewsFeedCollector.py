## downloading feeds

################
#              #
#   librarys   #
#              #
################
<<<<<<< HEAD
import re
=======

>>>>>>> 45089bb17c525039b232cd2cb97d9e34b26720a6
from xml.dom import minidom
import urllib
import simplifier
import database_stuff
<<<<<<< HEAD
import time
import dateutil
import dateutil.parser
=======
>>>>>>> 45089bb17c525039b232cd2cb97d9e34b26720a6

####################
#                  #
#  Database Stuff  #
#                  #
####################

<<<<<<< HEAD
database = database_stuff.t_database("localhost", "root", "", "elderbase")
=======
database = database_stuff.t_database
>>>>>>> 45089bb17c525039b232cd2cb97d9e34b26720a6

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
<<<<<<< HEAD
dater = CVE_Feed.getElementsByTagName('dc:date')

for index in range(0, len(dater)-1):
	pl = dater[index].toxml()
	pl = re.sub('\<[^>]+\>', '', pl)
	pl = re.sub('[A-Z]', ' ', pl)
	pl = pl[:-1]
	simplified = simplifier.simplify(str(description[index+1].toxml()))
	database.add_article(title[index+1].toxml(), link[index+1].toxml(), simplified, pl, simplifier.tagify(simplified))
	
database.commit()
=======
date = CVE_Feed.getElementsByTagName('dc:date')

for index in range len(date):
    description[index+1] = description[index+1].replace("<description>","")
    description[index+1] = description[index+1].replace("</description>","")
    simplified = simplifier.simplify(description[index+1])
    database.add_article(title[index+1], link[index+1], simplified, date[index], simplifier.tagify(simplified))
>>>>>>> 45089bb17c525039b232cd2cb97d9e34b26720a6
