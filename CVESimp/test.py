import simplifier
import sys
string = open(sys.argv[1]).read()
q = simplifier.simplify(string)
print q
print simplifier.tagify(q)
