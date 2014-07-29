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

database = database_stuff.t_database

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

for index in range len(date):
    description[index+1] = description[index+1].replace("<description>","")
    description[index+1] = description[index+1].replace("</description>","")
    simplified = simplifier.simplify(description[index+1])
    database.add_article(title[index+1], link[index+1], simplified, date[index], simplifier.tagify(simplified))
