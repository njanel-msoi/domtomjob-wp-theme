JS OBJECT {
"job_title": "", // the job title
// set here all the other fields which are not "meta"


// meta is an array of objects. list here all the "meta" fields in the following format
"meta": [
{
"name": "", // name of the meta field
"values": [
// value here, inside the array
]
}
],
"tags": [
{
"type": "category",
"id": null // here ID of the category (activity domain)
},
{
"type": "type",
"id": null // here ID of the job type
}
],
"files": [
{
"path": "company-logo/filename.jpg", // replace "filename.jpg" by the name of the file
"content": "" // place here the content of the file in "base64" format
}
]
}