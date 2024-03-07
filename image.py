import requests
import json
import os

print("Starting the generation of the image...")

# url = "https://stablediffusionapi.com/api/v3/text2img"
url = "http://api.novita.ai/v2/txt2img"
tkn = "a2145ca4-2540-4284-b06a-e238bf399a8c"

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



#payload = json.dumps({
#  "key": "2q9blmbiXuUYTJ78F6FxTESxJdd8ctv2IVJRj1bLy1Xr732cR3MYSTp6hZcA",
#  "prompt": prompt,
#  "negative_prompt": None,
#  "width": "512",
#  "height": "512",
#  "samples": "1",
#  "num_inference_steps": "20",
#  "seed": None,
#  "guidance_scale": 7.5,
#  "safety_checker": "yes",
##  "multi_lingual": "no",
#  "panorama": "no",
#  "self_attention": "no",
#  "upscale": "no",
#  "embeddings_model": None,
#  "webhook": None,
#  "track_id": None
#})


payload = json.dumps({
  "prompt": "fantastic,Best quality, masterpiece, ultra high res, (photorealistic:1.4), raw photo, 1girl, offshoulder, in the dark, deep shadow",
  "negative_prompt": "nsfw,ng_deepnegative_v1_75t, badhandv4, (worst quality:2), (low quality:2), (normal quality:2), lowres, ((monochrome)), ((grayscale)), watermark",
  "sampler_name": "DPM++ SDE Karras",
  "batch_size": 1,
  "n_iter": 1,
  "steps": 20,
  "cfg_scale": 7,
  "seed": -1,
  "height": 1024,
  "width": 1024,
  "model_name": "sd_xl_base_1.0.safetensors"
})

headers = {
  'Content-Type': 'application/json'
  'Authorization': 'Bearer a2145ca4-2540-4284-b06a-e238bf399a8c'
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
    print(response_data)