## downloading feeds

################
#              #
#   librarys   #
#              #
################

from xml.dom import minidom
import urllib
import simplifier
import database_stuff

####################
#                  #
#  Database Stuff  #
#                  #
####################

database = t_database

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
date = CVE_Feed.getElementsByTagName('dc:date')

for s in range len(date):
    s = s.toxml()
    s = s.replace("<description>", "")
    s = s.replace("</description>","")
    s = simplifier.simplify(s)
    print s
    print simplifier.tagify(s)	

database.add_article(database,title
f = input("")