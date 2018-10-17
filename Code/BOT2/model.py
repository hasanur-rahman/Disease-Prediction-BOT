import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn.externals import joblib

'''dt = 0
feature_dict = {}
features = 0'''

def TrainModel():
    #global dt,feature_dict,features
    data = pd.read_csv("C:\\xampp\\htdocs\\server\\BOT2\\Manual-Data\\Training.csv")
    df = pd.DataFrame(data)

    cols = df.columns[:-1]
    x = df[cols]
    y = df['prognosis']

    x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.33, random_state=42)

    dt = DecisionTreeClassifier()
    dt.fit(x_train,y_train)

    importances = dt.feature_importances_
    indices = np.argsort(importances)[::-1]

    features = cols
    feature_dict = {}
    for i,f in enumerate(features):
        feature_dict[f] = i

    joblib.dump(dt,'C:\\xampp\\htdocs\\server\\BOT2\\dt.joblib')
    joblib.dump(feature_dict, 'C:\\xampp\\htdocs\\server\\BOT2\\feature_dict.joblib')
    joblib.dump(features, 'C:\\xampp\\htdocs\\server\\BOT2\\features.joblib')

    return

def getPrediction(symptoms):
    dt = joblib.load('C:\\xampp\\htdocs\\server\\BOT2\\dt.joblib')
    feature_dict = joblib.load('C:\\xampp\\htdocs\\server\\BOT2\\feature_dict.joblib')
    features = joblib.load('C:\\xampp\\htdocs\\server\\BOT2\\features.joblib')
    pos = []

    for i in range(len(symptoms)):
        pos.append(feature_dict[symptoms[i]])

    sample_x = [1.0 if i in pos else 0.0 for i in range(len(features))]
    sample_x = np.array(sample_x).reshape(1,len(sample_x))
    return dt.predict(sample_x)
