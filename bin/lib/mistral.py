#!/usr/bin/env python3
import yaml
import json
from pathlib import Path
from repository import Repository
from mistralai.client import Mistral

def mistral_prompt(input: json = None):
    repo = Repository()
    config = repo.root_dir / ".secret.yaml"
    with open(config, "r", encoding="utf-8") as f:
        keys = yaml.safe_load(f) or None

    if keys:
        mistral_key = keys.get("api_keys", {}).get("mistral", {})
        client = Mistral(api_key=mistral_key)

        inputs = [
            {
                "role": "user",
                "content": "Oh, heya!"
            }
        ]
        args = {
            "temperature": 0.7,
            "max_tokens": 2048,
            "top_p": 1,
            "response_format": {
                "type": "json_schema",
                "json_schema": {
                    "name": "response_schema",
                    "schema": {
                        "properties": {
                            "ResponceMessage": {
                                "description": "",
                                "type": "string"
                            }
                        },
                        "required": [
                            "ResponceMessage"
                        ],
                        "type": "object"
                    }
                }
            },
        }
        tools=[]
        response = client.beta.conversations.start(
            inputs=inputs,
            model="mistral-medium-latest",
            instructions="Instructions",
            completion_args=args,
            tools=tools,
        )

        content = response.outputs[0].content
        data = json.loads(content)

        print(data["ResponceMessage"])

if __name__ == "__main__":
    mistral_prompt("")