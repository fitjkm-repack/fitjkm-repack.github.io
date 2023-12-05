import requests
import json
import os

print("Starting the generation of the image...")

url = "https://stablediffusionapi.com/api/v3/text2img"

prompt = ""

def find_largest_numbered_file(folder_path):
    largest_number = 0
    largest_file = None

    for root, dirs, files in os.walk(folder_path):
        for file in files:
            file_name, file_ext = os.path.splitext(file)
            if file_ext.lower() == '.docx' and file_name.split(" - ")[0].isdigit():
                number = int(file_name.split(' - ')[0].strip())
                if number > largest_number:
                    largest_number = number
                    largest_file = file

    return largest_file

folder_path = "repacks/"
largest_file = find_largest_numbered_file(folder_path)

if largest_file:
    prompt = largest_file.split('-')[1].strip()  # Get the part after the number
    prompt = os.path.splitext(prompt)[0]  # Remove the file extension
    print("Prompt:", prompt)
else:
    print("No matching files found in the specified folder.")

payload = json.dumps({
  "key": "mdKJjPADJcGe5vw7khZ49nZDIRHy96x5tOFDevImUgZBSqetEe1h30ZV29Zd",
  "prompt": prompt,
  "negative_prompt": None,
  "width": "512",
  "height": "512",
  "samples": "1",
  "num_inference_steps": "20",
  "seed": None,
  "guidance_scale": 7.5,
  "safety_checker": "yes",
  "multi_lingual": "no",
  "panorama": "no",
  "self_attention": "no",
  "upscale": "no",
  "embeddings_model": None,
  "webhook": None,
  "track_id": None
})

headers = {
  'Content-Type': 'application/json'
}


response = requests.request("POST", url, headers=headers, data=payload)


response_data = response.json()

if response_data["status"] == "success":
    print("A", response_data["status"], "response was received in", response_data["generationTime"])
    link = response_data["output"][0]
    print("Link:", link)
    img_data = requests.get(link).content
    with open('image.png', 'wb') as handler:
        handler.write(img_data)
    print("Image saved at image.png")
else:
    print("A", response_data["status"], "response was received")