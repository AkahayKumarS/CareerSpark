import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder, StandardScaler
from sklearn.ensemble import StackingClassifier, RandomForestClassifier
from sklearn.linear_model import LogisticRegression
from xgboost import XGBClassifier
from imblearn.over_sampling import RandomOverSampler
from sklearn.pipeline import Pipeline

# Load and preprocess dataset
df = pd.read_csv("grouped_15000_cse_skills_job_roles.csv")

rating_map = {
    "Not Interested": 0, "Poor": 1, "Beginner": 2,
    "Average": 4, "Intermediate": 6, "Excellent": 8, "Professional": 10
}
for col in df.columns[:-1]:
    df[col] = df[col].map(rating_map)
df.dropna(inplace=True)

le = LabelEncoder()
df["EncodedRoles"] = le.fit_transform(df[df.columns[-1]])

X = df.iloc[:, :-2].values
y = df["EncodedRoles"].values

ros = RandomOverSampler(random_state=42)
X_resampled, y_resampled = ros.fit_resample(X, y)

X_train, X_test, y_train, y_test = train_test_split(
    X_resampled, y_resampled, test_size=0.3, random_state=42
)

# Pipelines for base models
xgb_pipe = Pipeline([
    ('scaler', StandardScaler()),
    ('xgb', XGBClassifier(random_state=42, eval_metric='mlogloss', max_depth=6, learning_rate=0.1, n_estimators=200))
])

rf_pipe = Pipeline([
    ('scaler', StandardScaler()),
    ('rf', RandomForestClassifier(n_estimators=150, max_depth=10, random_state=42))
])

logreg_pipe = Pipeline([
    ('scaler', StandardScaler()),
    ('logreg', LogisticRegression(max_iter=1500))
])

# Stacking classifier
stack_model = StackingClassifier(
    estimators=[('xgb', xgb_pipe), ('rf', rf_pipe), ('logreg', logreg_pipe)],
    final_estimator=RandomForestClassifier(n_estimators=120),
    cv=5, n_jobs=-1
)

# Train model
stack_model.fit(X_train, y_train)

