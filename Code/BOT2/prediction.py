import sys
import model

def predict():
	length = len(sys.argv)
	symptoms = sys.argv[1:length]

	f = open('new.txt','w+')
	for item in symptoms:
		f.write("%s\n" % item)
	f.close()
	#
	#print('Here\n')
	#print(model.getPrediction(symptoms));
	'''f = open('new.txt','w')
	f.write("hasan")
    for item in symptoms:
        f.write("%s\n" % item)
	f.close()'''

	ot = model.getPrediction(symptoms)
	print(ot)
	return ot
	
	#am.close()

predict()