import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix
from xgboost import XGBClassifier
import pickle
import matplotlib.pyplot as plt
import seaborn as sns

# Load dataset
df = pd.read_csv("computer_science_student_career_datasetMar62024.csv")

# Print column names and first few rows for verification
print("Columns:", df.columns.tolist())
print(df.head())

# Drop any rows with missing values
df.dropna(inplace=True)

# Encode categorical features if any (excluding target)
label_encoders = {}
for col in df.columns:
    if df[col].dtype == "object" and col != "Career":
        le = LabelEncoder()
        df[col] = le.fit_transform(df[col])
        label_encoders[col] = le

# Encode the target variable 'Career'
target_encoder = LabelEncoder()
df['Career_Goals'] = target_encoder.fit_transform(df['Career_Goals'])

# Split features and target
X = df.drop('Career_Goals', axis=1).values
y = df['Career_Goals'].values

# Split into train and test sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=42)

# Train XGBoost model
model = XGBClassifier(use_label_encoder=False, eval_metric='mlogloss', random_state=42)
model.fit(X_train, y_train)

# Predict
y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)
print(f"\n✅ Accuracy: {accuracy * 100:.2f}%")

# Save model
pickle.dump(model, open("career_model_xgb.pkl", "wb"))
print("Model saved as 'career_model_xgb.pkl'")

# Decode career predictions back to labels
y_test_labels = target_encoder.inverse_transform(y_test)
y_pred_labels = target_encoder.inverse_transform(y_pred)

# Classification report
print("\nClassification Report:")
print(classification_report(y_test_labels, y_pred_labels))

# Confusion Matrix
conf_matrix = confusion_matrix(y_test_labels, y_pred_labels)
plt.figure(figsize=(10, 6))
sns.heatmap(conf_matrix, annot=True, fmt='d', xticklabels=target_encoder.classes_, yticklabels=target_encoder.classes_, cmap="YlGnBu")
plt.title("Confusion Matrix")
plt.xlabel("Predicted")
plt.ylabel("Actual")
plt.tight_layout()
plt.show()
