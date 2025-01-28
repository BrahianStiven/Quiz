import csv
import os
import random

from dotenv import load_dotenv
from flask import Flask, jsonify, request, send_file

load_dotenv()

app = Flask(__name__)


def check_api_key():
    api_key = request.headers.get("X-API-Key")
    print(api_key)
    if api_key != os.getenv("API_KEY"):
        return jsonify({"error": "Unauthorized"}), 401


def generate_random_labels(n):
    genres = ["Pop", "Rock", "Hip-Hop"]
    labels = []
    for _ in range(n):
        label = {
            "name": f"Label_{random.randint(1, 10)}",
            "genre": random.choice(genres),
            "founded_year": random.randint(1950, 2025),
        }
        labels.append(label)
    return labels


@app.route("/generate_labels/", methods=["POST"])
def generate_labels():

    auth_response = check_api_key()
    if auth_response:
        return auth_response

    data = request.get_json()
    n = data.get("count", 10)

    labels = generate_random_labels(n)

    with open("labels.csv", mode="w", newline="", encoding="utf-8") as file:
        writer = csv.DictWriter(file, fieldnames=["name", "genre", "founded_year"])
        writer.writeheader()
        writer.writerows(labels)

    return jsonify({"message": f"Successfully generated {n} labels"}), 200


@app.route("/record_labels", methods=["GET"])
def record_labels():

    auth_response = check_api_key()
    if auth_response:
        return auth_response

    csv_file = "labels.csv"

    if not os.path.exists(csv_file):
        return jsonify({"error": "No csv file found"}), 404

    return send_file(csv_file, as_attachment=True)
