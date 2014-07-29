import nltk
import string

def simplify(string):
	simplified = ""
	q = nltk.pos_tag(nltk.word_tokenize(string))
	prev_in = 0
	write = []
	for i in range(0, len(q)):
		if q[i][1] == "CD":
			if i>=1:
				if q[i-1][1] == "IN":
					write[len(write)-1] = ""
			# Integer, do nothing
		elif q[i][0] == "," or q[i][0][0] == "(":
			break
		else:
			write.append(q[i][0])
	simplified = ' '.join(write)
	simplified = simplified.replace("  ", " ")
	return simplified
	
def tagify(string):
	tags = []
	for i in nltk.pos_tag(nltk.word_tokenize(string)):
		if i[1][:3] == "NNP":
			tags.append(i[0])
	return tags


