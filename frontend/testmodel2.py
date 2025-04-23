import pandas as pd
import numpy as np
import pickle
from collections import Counter
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix
from sklearn.preprocessing import LabelEncoder, StandardScaler
from sklearn.ensemble import StackingClassifier, RandomForestClassifier
from sklearn.linear_model import LogisticRegression
from xgboost import XGBClassifier
from imblearn.over_sampling import RandomOverSampler
from sklearn.pipeline import Pipeline
import matplotlib.pyplot as plt
import seaborn as sns

# Load dataset
df = pd.read_csv("grouped_15000_cse_skills_job_roles.csv")

# Custom rating map with more gap
rating_map = {
    "Not Interested": 0,
    "Poor": 1,
    "Beginner": 2,
    "Average": 4,
    "Intermediate": 6,
    "Excellent": 8,
    "Professional": 10
}

# Apply rating mapping
for col in df.columns[:-1]:
    df[col] = df[col].map(rating_map)

df.dropna(inplace=True)

# Encode target
le = LabelEncoder()
df["EncodedRoles"] = le.fit_transform(df[df.columns[-1]])

# Save label encoder
with open("label_encoder.pkl", "wb") as f:
    pickle.dump(le, f)

# Features/Target
X = df.iloc[:, :-2].values
y = df["EncodedRoles"].values

# Original class distribution plot
original_counts = Counter(y)
plt.figure(figsize=(10, 5))
sns.barplot(x=list(le.inverse_transform(list(original_counts.keys()))), y=list(original_counts.values()))
plt.xticks(rotation=45)
plt.title("Original Class Distribution")
plt.xlabel("Career Roles")
plt.ylabel("Count")
plt.tight_layout()
plt.show()

# Oversample
ros = RandomOverSampler(random_state=42)
X_resampled, y_resampled = ros.fit_resample(X, y)

# Resampled class distribution plot
resampled_counts = Counter(y_resampled)
plt.figure(figsize=(10, 5))
sns.barplot(x=list(le.inverse_transform(list(resampled_counts.keys()))), y=list(resampled_counts.values()))
plt.xticks(rotation=45)
plt.title("Resampled Class Distribution (Balanced)")
plt.xlabel("Career Roles")
plt.ylabel("Count")
plt.tight_layout()
plt.show()

# Split
X_train, X_test, y_train, y_test = train_test_split(
    X_resampled, y_resampled, test_size=0.3, random_state=42
)

# Pipelines
xgb = XGBClassifier(random_state=42, eval_metric='mlogloss', max_depth=6, learning_rate=0.1, n_estimators=200)
xgb_pipe = Pipeline([('scaler', StandardScaler()), ('xgb', xgb)])

rf_pipe = Pipeline([('scaler', StandardScaler()), ('rf', RandomForestClassifier(n_estimators=150, max_depth=10, random_state=42))])
logreg_pipe = Pipeline([('scaler', StandardScaler()), ('logreg', LogisticRegression(max_iter=1500))])

# Stacking
stack_model = StackingClassifier(
    estimators=[('xgb', xgb_pipe), ('rf', rf_pipe), ('logreg', logreg_pipe)],
    final_estimator=RandomForestClassifier(n_estimators=120),
    cv=5, n_jobs=-1
)

# Train
stack_model.fit(X_train, y_train)

# Predict
y_pred = stack_model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)
print(f"\n✅ Accuracy: {accuracy * 100:.2f}%")

# Save model
with open("careerlast.pkl", "wb") as f:
    pickle.dump(stack_model, f)

print("✅ Model saved as 'careerlast.pkl'")

# Classification Report
print("\nClassification Report:")
print(classification_report(y_test, y_pred, target_names=le.classes_))

# Confusion Matrix
cm = confusion_matrix(y_test, y_pred)
plt.figure(figsize=(10, 8))
sns.heatmap(cm, annot=True, cmap="Blues", fmt="d", xticklabels=le.classes_, yticklabels=le.classes_)
plt.xlabel("Predicted")
plt.ylabel("Actual")
plt.title("Confusion Matrix")
plt.xticks(rotation=45)
plt.tight_layout()
plt.show()

# Feature Importance from fitted XGBoost inside pipeline
fitted_xgb = stack_model.named_estimators_['xgb'].named_steps['xgb']
feature_names = df.columns[:-2]
importance = fitted_xgb.feature_importances_

plt.figure(figsize=(12, 7))
sns.barplot(x=importance, y=feature_names)
plt.title("XGBoost Feature Importance (Top Skills)")
plt.xlabel("Importance Score")
plt.ylabel("Skills")
plt.tight_layout()
plt.show()
