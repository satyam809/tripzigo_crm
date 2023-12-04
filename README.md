### Demo:
- Frontend Application (React + NodeJS)
  - https://www.tripzygo.in/
- CRM Application (PHP)
  - https://awtrips.com/crm/login.html
    - Email address - info@tripzygo.in
    - Password - Manish@7979
- Staging (tripzygo.online)
  - https://hpanel.hostinger.com/
    - dev@booleans.in
    - Booleans@1309
   - tripzygo.online
     - Email address - info@tripzygo.in
     - Password - admin@3214
- Production (https://awtrips.com:2083/)
  - cPanel details:
    - usrname : tripzfym
    - pass: @Tripzygo@2023#

- Callerdesk Info
  - Docs: api.callerdesk.io
  - App: app.callerdesk.io
  - user name: udit20221123161443@callerdesk.io
  - pass: 09999075570
  - Authcode  = 5f4d824d89e9063bc5085aefeae669c6
  - Deskphone = 8069145525

### Technology Stack:
- Plain PHP
- Project has root folders which has multiple libraries
- Project has *.php files as pages
- Project has a `config` directory for database and other configs

### Objectives
1. Expose APIs for React Frontend
  - Either of 2 objectives:
    - (A) Integrate NodeJS application with same database being used by CRM application.
    - (B) Build some APIs on top of PHP CRM Application
  - APIs required
    - (a) Return list of packages with a search and filter criteria
    - (b) Return details of a package
    - (c) Return list of collections with search and filter criteria. Also return packages of the collection.
    - (d) POST request to capture email for newsletter
    - (e) POST request to create a booking enquiry - should become visible in the CRM with the required details
2. React Frontend with design
  - Update the design based on new Figma Design
  - Pages: Homepage, Packages (with filters), Package Detail, Contct Us, About Us, Newsletter Form, Booking Enquiry form
3. Build a CMS to allow admins to upload itineraries
  - Pages Required
    - (a) CRUD for packages - allow to manage packages being shown at frontend
        - 1. Description
        - 2. Location - will be useful for maps and an overall location
        - 3. Hotel - Dropdown with - 1_star, 2_star, 3_star, 4_star, 5_star, any (In the UI we should show the stars instead of text)
    - (b) Manual entry for a user with requirements [Done]
    - (c) Allow to create tags for packages - eg. Luxury, Budget, Honeymoon, etc [Done]
    - (d) CRUD for collections - collections can have one or more packages [Done]
4. Integrate with CallerDesk to allow to make calls from within CRM
  - Allow to make calls right from the PHP CRM tool
5. Deployment
  - Deploy the complete solution to cloud with database backups daily
  - Ensure we have some basic analytics on - like visits per day (google analytics)
6. Payment Integration
  - Razorpay / JustPay

## APIs required
(a) Return list of packages with a search and filter criteria

- API: GET /api/packages?
- Supported Search (Query Param: `q`): Itinerary Name, Itinerary Destinations. Search should support partial search as well. If there are tags associated with an itinerary - then we should also be able to search via those taggings.
- Supported Filters:

1. Type of destination (Query Param: `destination_type`) = domestic | international
2. Duration (Query Param: `duration`) = min__max (eg. 1_3 | 4_6 | 7_9 | 10_12 | 13_)
3. Type of tour (Query Param: `tour_type`) = honeymoon | family | friends | solo | couple
4. Type of activity (Query Param: `activity_type`) = adventure | city | self_drive | water_activities | cultural
5. Type of landscape (Query Param: `landscape_type`) = beach | mountain | city | country_side
6. Budget (Query Param: `budget`) = min__max (eg. 10000_50000)

- API should be paginated and support `page` param and `per_page` param
- Response
```
{
  "data": [
    {
      id: "itinerary_id",
      type: "itinerary",
      name: "",
      description: "",
      cover_image: "",
      images: ["url1", "url2"],
      start_date: ,
      end_date: ,
      duration: , // in days
      tags: [],
      adult: 2
      child: 0,
      destinations: "",
      location: "",
      notes: "",
      star_rating: "",
      hotel: "",
      total_price: "", // without discount, gst and tcs
      display_price: "", // with discount, without gst and tcs
      gst_amount: "",
      tcs_amount: "",
      discount: "",
    }, ...
  ],
  "meta": {
    "total": 95,
    "per_page": 10,
    "pages": 10,
    "current_page": 2,
  }
}
```
(b) Return details of a package

- API: GET /api/packages/:package_id
```
{
  "data": {
    id: "itinerary_id",
    type: "itinerary",
    name: "",
    description: "",
    cover_image: "",
    images: ["url1", "url2"],
    start_date: ,
    end_date: ,
    duration: , // in days
    tags: [],
    adult: 2
    child: 0,
    destinations: "",
    location: "",
    notes: "",
    star_rating: "",
    hotel: "",
    total_price: "", // without discount, gst and tcs
    display_price: "", // with discount, without gst and tcs
    gst_amount: "",
    tcs_amount: "",
    discount: "",
  },
  "meta": {
  }
}
```

(c) Return list of collections with search and filter criteria. Also return packages of the collection.

- API: GET /api/collections?
- Supported Search (Query Param: `q`): Collection Name, Collection Location. Search should support partial search as well. If there are tags associated with a collection - then we should also be able to search via those taggings.
- Supported Filters:

1. Type of destination (Query Param: `destination_type`) = domestic | international
2. Duration (Query Param: `duration`) = min__max (eg. 1_3 | 4_6 | 7_9 | 10_12 | 13_)
3. Type of tour (Query Param: `tour_type`) = honeymoon | family | friends | solo | couple
4. Type of activity (Query Param: `activity_type`) = adventure | city | self_drive | water_activities | cultural
5. Type of landscape (Query Param: `landscape_type`) = beach | mountain | city | country_side
6. Budget (Query Param: `budget`) = min__max (eg. 10000_50000)

- API should be paginated and support `page` param and `per_page` param
- Response
```
{
  "data": [
    {
      id: "collection_id",
      type: "collection",
      name: "",
      "description": "",
      cover_image: "",
      images: ["url1", "url2"],
      duration_range: "10__30" // Package with min and max duration
      price_range: "10000__30000", // Package with min and max price
      star_rating_range: "1_star__4_star", // Package with min and max star rating hotel
      tags: [],
      adult: 2
      child: 0,
      location: "",
      notes: "",
    } ...
  ],
  "meta": {
    "total": 95,
    "per_page": 10,
    "pages": 10,
    "current_page": 2,
  }
}
```

(d) POST request to capture email for newsletter

- POST /api/newsletter
- Will need a new table for this maybe - "Newsletter" with following: client_id, created_at, updated_at, "status" - subscribed | unsubscribed
  - Email, Phone, First Name, Last Name - should go inside Clients table
- Params: 
```
{
  first_name: "", // Optional
  last_name: "", // Optional
  email: "", // Mandatory
  phone: "", // optional
}
```

- If the email is duplicate - we should return an error saying "You have already shown interest in our newsletter"

- Response
  - 200 Success
  - 4XX - Client error
{
  error: "error message"
}

(e) POST request to create a booking enquiry - should become visible in the CRM with the required details

- POST /api/enquiry
- Will create an entry in QUERY page (check which DB table)
- Params: 
```
{
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
  adults: 2,
  child: 2,
  start_date: "", // Optional
  end_date: "", // Optional
  month_of_travel: "", // Will be added in notes in backend
  budget: "", // optional  - will be added in notes in backend IF we dont have a field for this in query
  notes: "", // Optional
  itinerary_id: "", // Optional
  collection_id: "", // Optional
}
```

# Deployment Notes

### Staging

1. login on Cpanel
2. go to File Manager
3. go to public_html folder
5. replace updated source code here
6. open PHPMyadmin
7. go to the import menu
8. upload changes SQL file and press the go button

### Production

1. login on Cpanel
2. go to File Manager
3. go to public_html folder
4. go to crm folder
5. replace update source code here
6. open PHPMyadmin
7. go to import menu
8. upload changes sql file and press go button


## APIs required
(a) Return list of packages with a search and filter criteria

- API: GET /api/packages?
- Supported Search (Query Param: `q`): Itinerary Name, Itinerary Destinations. Search should support partial search as well. If there are tags associated with an itinerary - then we should also be able to search via those taggings.
- Supported Filters:

1. Type of destination (Query Param: `destination_type`) = domestic | international
2. Duration (Query Param: `duration`) = min__max (eg. 1_3 | 4_6 | 7_9 | 10_12 | 13_)
3. Type of tour (Query Param: `tour_type`) = honeymoon | family | friends | solo | couple
4. Type of activity (Query Param: `activity_type`) = adventure | city | self_drive | water_activities | cultural
5. Type of landscape (Query Param: `landscape_type`) = beach | mountain | city | country_side
6. Budget (Query Param: `budget`) = min__max (eg. 10000_50000)

- API should be paginated and support `page` param and `per_page` param
- Response
```
{
  "data": [
    {
      id: "itinerary_id",
      type: "itinerary",
      name: "",
      description: "",
      cover_image: "",
      images: ["url1", "url2"],
      start_date: ,
      end_date: ,
      duration: , // in days
      tags: [],
      adult: 2
      child: 0,
      destinations: "",
      location: "",
      notes: "",
      star_rating: "",
      hotel: "",
      total_price: "", // without discount, gst and tcs
      display_price: "", // with discount, without gst and tcs
      gst_amount: "",
      tcs_amount: "",
      discount: "",
    }, ...
  ],
  "meta": {
    "total": 95,
    "per_page": 10,
    "pages": 10,
    "current_page": 2,
  }
}
```
(b) Return details of a package

- API: GET /api/packages/:package_id
```
{
  "data": {
    id: "itinerary_id",
    type: "itinerary",
    name: "",
    description: "",
    cover_image: "",
    images: ["url1", "url2"],
    start_date: ,
    end_date: ,
    duration: , // in days
    tags: [],
    adult: 2
    child: 0,
    destinations: "",
    location: "",
    notes: "",
    star_rating: "",
    hotel: "",
    total_price: "", // without discount, gst and tcs
    display_price: "", // with discount, without gst and tcs
    gst_amount: "",
    tcs_amount: "",
    discount: "",
  },
  "meta": {
  }
}
```

(c) Return list of collections with search and filter criteria. Also return packages of the collection.

- API: GET /api/collections?
- Supported Search (Query Param: `q`): Collection Name, Collection Location. Search should support partial search as well. If there are tags associated with a collection - then we should also be able to search via those taggings.
- Supported Filters:

1. Type of destination (Query Param: `destination_type`) = domestic | international
2. Duration (Query Param: `duration`) = min__max (eg. 1_3 | 4_6 | 7_9 | 10_12 | 13_)
3. Type of tour (Query Param: `tour_type`) = honeymoon | family | friends | solo | couple
4. Type of activity (Query Param: `activity_type`) = adventure | city | self_drive | water_activities | cultural
5. Type of landscape (Query Param: `landscape_type`) = beach | mountain | city | country_side
6. Budget (Query Param: `budget`) = min__max (eg. 10000_50000)

- API should be paginated and support `page` param and `per_page` param
- Response
```
{
  "data": [
    {
      id: "collection_id",
      type: "collection",
      name: "",
      "description": "",
      cover_image: "",
      images: ["url1", "url2"],
      duration_range: "10__30" // Package with min and max duration
      price_range: "10000__30000", // Package with min and max price
      star_rating_range: "1_star__4_star", // Package with min and max star rating hotel
      tags: [],
      adult: 2
      child: 0,
      location: "",
      notes: "",
    } ...
  ],
  "meta": {
    "total": 95,
    "per_page": 10,
    "pages": 10,
    "current_page": 2,
  }
}
```

(d) POST request to capture email for newsletter

- POST /api/newsletter
- Will need a new table for this maybe - "Newsletter" with following: client_id, created_at, updated_at, "status" - subscribed | unsubscribed
  - Email, Phone, First Name, Last Name - should go inside Clients table
- Params: 
```
{
  first_name: "", // Optional
  last_name: "", // Optional
  email: "", // Mandatory
  phone: "", // optional
}
```

- If the email is duplicate - we should return an error saying "You have already shown interest in our newsletter"

- Response
  - 200 Success
  - 4XX - Client error
{
  error: "error message"
}

(e) POST request to create a booking enquiry - should become visible in the CRM with the required details

- POST /api/enquiry
- Will create an entry in QUERY page (check which DB table)
- Params: 
```
{
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
  adults: 2,
  child: 2,
  start_date: "", // Optional
  end_date: "", // Optional
  month_of_travel: "", // Will be added in notes in backend
  budget: "", // optional  - will be added in notes in backend IF we dont have a field for this in query
  notes: "", // Optional
  itinerary_id: "", // Optional
  collection_id: "", // Optional
}
```
