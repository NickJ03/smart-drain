import streamlit as st
import pymysql
import pandas as pd
import datetime as dt
import matplotlib.pyplot as plt
import time

# Database connection configuration
config = {
    'user': '245',
    'password': '245',
    'host': 'localhost',
    'database': 'smart_drain',
}

@st.cache(allow_output_mutation=True, ttl=60)
def fetch_data():
    """Fetch data from the database."""
    # Connect to MySQL
    conn = pymysql.connect(**config)
    query = "SELECT * FROM water_usage"
    df = pd.read_sql(query, conn)
    conn.close()
    return df

# Set title and subtitle
st.title("The amount of water usage")
st.subheader("group245")

df = fetch_data()

# Process the data
df['timestamp'] = pd.to_datetime(df['timestamp'])
daily_usage = df.groupby(df['timestamp'].dt.hour)['volume'].sum()
monthly_usage = df.groupby(df['timestamp'].dt.month)['volume'].sum()

# Daily water usage graph
max_hour = daily_usage.idxmax()
colors = ['red' if x == max_hour else 'blue' for x in daily_usage.index]

fig1, ax1 = plt.subplots()
daily_usage.plot(kind='bar', color=colors, ax=ax1)
ax1.set_title("Daily Water Usage (ml) per Hour")
ax1.set_xlabel("Hour")
ax1.set_ylabel("Water Usage (ml)")
st.pyplot(fig1)

# Monthly water usage graph
max_month = monthly_usage.idxmax()
colors = ['red' if x == max_month else 'blue' for x in monthly_usage.index]

fig2, ax2 = plt.subplots()
monthly_usage.plot(kind='bar', color=colors, ax=ax2)
ax2.set_title("Monthly Water Usage (ml)")
ax2.set_xlabel("Month")
ax2.set_ylabel("Water Usage (ml)")
st.pyplot(fig2)

# Hour with maximum usage
max_hour = daily_usage.idxmax()
st.write(f"The most water usage occurred at {max_hour}:00 hours")

# Wait for 1 minute
time.sleep(60)
