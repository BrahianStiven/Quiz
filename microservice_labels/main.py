from flask import Flask, request, jsonify, send_file
import random
import csv
import os

app = Flask(__name__)

@app.route("/")
def hello_world():
    return "<p>Hello, World!</p>"


def generate_random_labels(n):
    genres = ["Pop", "Rock", "Hip-Hop"]
    labels = []
    for _ in range(n):
        label = {
            "name": f"Label_{random.randint(1, 10)}",
            "genre": random.choice(genres),
            "founded_year": random.randint(1950, 2025)
        }
        labels.append(label)
    return labels


@app.route("/generate_labels/", methods=["POST"])
def generate_labels():
    data = request.get_json()
    n = data.get("count", 10)

    
    labels = generate_random_labels(n)

    with open('labels.csv', mode="w", newline="", encoding="utf-8") as file:
            writer = csv.DictWriter(file, fieldnames=["name", "genre", "founded_year"])
            writer.writeheader()
            writer.writerows(labels)

    return jsonify({"message": f"Successfully generated {n} labels"}), 200


@app.route("/record_labels", methods=["GET"])
def record_labels():
    csv_file = "labels.csv"

    if not os.path.exists(csv_file):
        return jsonify({"error": "No CSV file found. Generate labels first!"}), 404

    return send_file(csv_file, as_attachment=True)