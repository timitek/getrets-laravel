﻿# getrets-laravel

A laravel package for the GetRETS&reg; API from timitek (<http://www.timitek.com>).  

Based on the PHP SDK found at (<https://github.com/timitek/getrets-php-sdk>).

**GetRETS&reg;** is a product / service developed by timitek that makes it possible to quickly build real estate related applications for pulling listing data from several MLS's without having to know anything about RETS or IDX or worry about the pains of mapping and storing listing data from these various sources. 

**GetRETS&reg;** as a service provides a RESTful API endpoint for consuming the data, and although it's not limited to only being used in PHP applications, and users aren't required to use our SDK, we have provided a simple PHP SDK for the API and set of documentation for it's use.

***

# Table of Contents
* [Setup](#setup)
  * [Compatibility Guide](#compatibility-guide)
  * [Install](#install)
  * [View Example Pages](#view-example-pages)
* [Listing](#listing)
  * [searchByKeyword](#searchbykeyword)
  * [search](#search)
  * [details](#details)
  * [imageUrl](#imageurl)
* [RETSListing](#retslisting)
  * [searchByKeyword](#searchbykeyword-1)
  * [search](#search-1)
  * [details](#details-1)
  * [imageUrl](#imageurl-1)
  * [executeDMQL](#executedmql)
  * [getListingsByDMQL](#getlistingsbydmql)
* [Geocoding](#geocoding)
  * [parseGoogleResults](#parsegoogleresults)
  * [googleGeocode](#googlegeocode)
* [Helper Functions](#helper-functions)
* [Further Reading](#further-reading)


***

# Setup

## Compatibility Guide

| Laravel Version | Package Tag |
|-----------------|-------------|
| 5.5.x | 1.1.x |
| 5.4.x | [1.0.x](<https://github.com/timitek/getrets-laravel/tree/1.0.5>) |

## Install

To add to an existing Laravel application run the following command.

```
composer require timitek/getrets-laravel
```

**Note**: *For Laravel 5.4 and older it is necessary to add the following to the providers section within config/app.php.*

```php
Timitek\GetRETS\Providers\GetRETSServiceProvider::class,
``` 

Publish the config file to config/getrets.php with the following command.

```
php artisan vendor:publish --provider="Timitek\GetRETS\Providers\GetRETSServiceProvider" --tag=config
```

You may now add the customer key provided to you by timitek.com by either modifying the config/getrets.php or by adding the following to your .env file.

```
GETRETS_CUSTOMER_KEY=your_customer_key_from_timitek
```

## View Example Pages

A sample [controller](<https://github.com/timitek/getrets-laravel/blob/master/app/Http/Controllers/ExampleController.php>) and [view](<https://github.com/timitek/getrets-laravel/tree/master/resources/views/example>) have been provided to help you get started.

To test the installation enable the examples, start the project, and browse to /getrets/example.

To enable the sampe code set the GETRETS_ENABLE_EXAMPLE to true in your .env file.

```
GETRETS_ENABLE_EXAMPLE=true
```

Serve the application on the PHP development server by running;

```
php artisan serve
```

View the project examples by browsing too

<http://localhost:8000/getrets/example>


To disable the sampe code set the GETRETS_ENABLE_EXAMPLE to false in your .env file.

```
GETRETS_ENABLE_EXAMPLE=false
```

***

# Listing
> The main controller for working with the listings using the pre-fetched / cached data.

[Swagger Documentation](http://getrets.net/swagger/ui/index#/Listing "")

```php
GetRETS::getListing();
```
This is the main entry point for retrieving **cached** listings.  Using this entry point will pull listing data that has been **pre-fetched** from your MLS.  

**Advantages**
* Faster retrieval of data *(The retrieval of data does not have to be negotiated and translated with your MLS RETS provider)*
* More advanced searching *(Since it's pre-fetched data we aren't limited to DMQL queries or other limitations by the RETS provider)*
* Works even when the MLS is down for maintenance

**Disadvantages**
* Data is not 100% live *(We are constantly polling the MLS for new data but it could be an hour or so before new listings show up, and we refresh each listing every 24 hours)*

***

## searchByKeyword
> Search for listings by keyword

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_SearchByKeyword "")

```php
GetRETS::getListing()->searchByKeyword($preparedKeywords);
```
A simple search that will retrieve listings by a keyword search.

### Parameters

***keyword*** - Keywords to search on

### Returns

An array of **CondensedListing**'s
```
[
  {
    "id": "string",
    "listingSourceURLSlug": "string",
    "listingTypeURLSlug": "string",
    "listingID": "string",
    "listingSource": 1,
    "listingType": 1,
    "address": "string",
    "baths": 0,
    "beds": 0,
    "listPrice": "string",
    "rawListPrice": 0,
    "providedBy": "string",
    "squareFeet": 0,
    "lot": "string",
    "acres": "string"
  }
]
```

***

## search
> Advanced search

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_Search "")

```php
GetRETS::getListing()->search($keywords, $extra, $maxPrice, $minPrice, $beds, $baths, $includeResidential, $includeLand, $includeCommercial);
```
A more advanced search that retrieves listings constrained by the optional parameters.

### Parameters

***keyword*** - Keywords to search on

***extra*** - *(optional)* Comma seperated list of extra terms to search for (golf, lake, etc...)

***maxPrice*** - *(optional)* The maximum listing price

***minPrice*** - *(optional)* The minimum listing price

***beds*** - *(optional)* The minimum number of beds to require

***baths*** - *(optional)* The minimum number of baths to require

***includeResidential*** - *(optional)* Include residential listings

***includeLand*** - *(optional)* Include land listings

***includeCommercial*** - *(optional)* Include commercial listings

*Note* - If you don't set any of the *include* parameters, all will be assumed as set.

### Returns

An array of **CondensedListing**'s
```
[
  {
    "id": "string",
    "listingSourceURLSlug": "string",
    "listingTypeURLSlug": "string",
    "listingID": "string",
    "listingSource": 1,
    "listingType": 1,
    "address": "string",
    "baths": 0,
    "beds": 0,
    "listPrice": "string",
    "rawListPrice": 0,
    "providedBy": "string",
    "squareFeet": 0,
    "lot": "string",
    "acres": "string"
  }
]
```

***

## details
> Get details for a specific listing

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_GetListingDetails "")

```php
GetRETS::getListing()->details($listingSource, $listingType, $listingId);
```
Retrieves the more specific / non condensed details for a listing.  You will typically use the values returned from search functions as the parameters.

### Parameters

***listingSource*** - A string representation of the MLS listing source (see FeedsModels.Models.enumListingSource)

***listingType*** - A string representation of the listing type such as residential, land etc.. (see FeedsModels.Models.enumListingType)

***listingId*** - The unique ID for the listing to retrieve the listing for

### Returns

A single **Listing**
```
{
  "description": "string",
  "features": [
    "string"
  ],
  "photoCount": 0,
  "id": "string",
  "listingSourceURLSlug": "string",
  "listingTypeURLSlug": "string",
  "listingID": "string",
  "listingSource": 1,
  "listingType": 1,
  "address": "string",
  "baths": 0,
  "beds": 0,
  "listPrice": "string",
  "rawListPrice": 0,
  "providedBy": "string",
  "squareFeet": 0,
  "lot": "string",
  "acres": "string"
}
```

***

## imageUrl
> Get URL to use for displaying an image

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_Image "")

```php
GetRETS::getListing()->imageUrl($listingSource, $listingType, $listingId, $photoId, $width = null, $height = null);
```
Retrieves an image(s) associated with a specific listing.

***Special Note*** - While the width and height parameters are optional, using them to specify an appropriate image size will increase the speed in which your site renders by lowering the need to download a full size image.

Also, fetching the first photo ($photoId = 0) is a suggested strategy for displaying a thumbnail image.

### Parameters

***listingSource*** - A string representation of the MLS listing source (see FeedsModels.Models.enumListingSource)

***listingType*** - A string representation of the listing type such as residential, land etc.. (see FeedsModels.Models.enumListingType)

***listingId*** - The unique ID for the listing to retrieve the listing for

***photoId*** - A zero based index for the photo to retrieve *(see the photoCount that is returned in the listing details)*.

***width*** - The width to be used for resizing the photo

***height*** - The height to be used for resizing the photo

### Returns

A URL for the image specified

***

# RETSListing
> The main controller for working with the listings using the the live data contained at the MLS using RETS.

[Swagger Documentation](http://getrets.net/swagger/ui/index#/RETSListing "")

```php
GetRETS::getRETSListing();
```
This is the main entry point for retrieving **live** listing data from the MLS via RETS.

**Advantages**
* The data is queried immediately from the MLS RETS server

**Disadvantages**
* A bit slower than the cached method. *(The data has be translated to DMQL and retreived from a 3rd party server)*.
* Keyword searches have less *"fuzzy logic"* applied to them as we are limited to only searching via the available DMQL classes as defined by the MLS.
* If your MLS is down for maintenance, results can not be retrieved.

***Special Note*** - All of the same functions used for fetching data from the cached data *(see listing controller functions above)* are applicable to this API controller as well, as the exist with the same signatures, only they will go directly to the RETS server.

***

## searchByKeyword
> Search for listings by keyword

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_SearchByKeyword "")

```php
GetRETS::getRETSListing()->searchByKeyword($preparedKeywords);
```
A simple search that will retrieve listings by a keyword search.

### Parameters

***keyword*** - Keywords to search on

### Returns

An array of **CondensedListing**'s
```
[
  {
    "id": "string",
    "listingSourceURLSlug": "string",
    "listingTypeURLSlug": "string",
    "listingID": "string",
    "listingSource": 1,
    "listingType": 1,
    "address": "string",
    "baths": 0,
    "beds": 0,
    "listPrice": "string",
    "rawListPrice": 0,
    "providedBy": "string",
    "squareFeet": 0,
    "lot": "string",
    "acres": "string"
  }
]
```

***

## search
> Advanced search

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_Search "")

```php
GetRETS::getRETSListing()->search($keywords, $extra, $maxPrice, $minPrice, $beds, $baths, $includeResidential, $includeLand, $includeCommercial);
```
A more advanced search that retrieves listings constrained by the optional parameters.

### Parameters

***keyword*** - Keywords to search on

***extra*** - *(optional)* Comma seperated list of extra terms to search for (golf, lake, etc...)

***maxPrice*** - *(optional)* The maximum listing price

***minPrice*** - *(optional)* The minimum listing price

***beds*** - *(optional)* The minimum number of beds to require

***baths*** - *(optional)* The minimum number of baths to require

***includeResidential*** - *(optional)* Include residential listings

***includeLand*** - *(optional)* Include land listings

***includeCommercial*** - *(optional)* Include commercial listings

*Note* - If you don't set any of the *include* parameters, all will be assumed as set.

### Returns

An array of **CondensedListing**'s
```
[
  {
    "id": "string",
    "listingSourceURLSlug": "string",
    "listingTypeURLSlug": "string",
    "listingID": "string",
    "listingSource": 1,
    "listingType": 1,
    "address": "string",
    "baths": 0,
    "beds": 0,
    "listPrice": "string",
    "rawListPrice": 0,
    "providedBy": "string",
    "squareFeet": 0,
    "lot": "string",
    "acres": "string"
  }
]
```

***

## details
> Get details for a specific listing

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_GetListingDetails "")

```php
GetRETS::getRETSListing()->details($listingSource, $listingType, $listingId);
```
Retrieves the more specific / non condensed details for a listing.  You will typically use the values returned from search functions as the parameters.

### Parameters

***listingSource*** - A string representation of the MLS listing source (see FeedsModels.Models.enumListingSource)

***listingType*** - A string representation of the listing type such as residential, land etc.. (see FeedsModels.Models.enumListingType)

***listingId*** - The unique ID for the listing to retrieve the listing for

### Returns

A single **Listing**
```
{
  "description": "string",
  "features": [
    "string"
  ],
  "photoCount": 0,
  "id": "string",
  "listingSourceURLSlug": "string",
  "listingTypeURLSlug": "string",
  "listingID": "string",
  "listingSource": 1,
  "listingType": 1,
  "address": "string",
  "baths": 0,
  "beds": 0,
  "listPrice": "string",
  "rawListPrice": 0,
  "providedBy": "string",
  "squareFeet": 0,
  "lot": "string",
  "acres": "string"
}
```

***

## imageUrl
> Get URL to use for displaying an image

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Listing/Listing_Image "")

```php
GetRETS::getRETSListing()->imageUrl($listingSource, $listingType, $listingId, $photoId, $width = null, $height = null);
```
Retrieves an image(s) associated with a specific listing.

***Special Note*** - While the width and height parameters are optional, using them to specify an appropriate image size will increase the speed in which your site renders by lowering the need to download a full size image.

Also, fetching the first photo ($photoId = 0) is a suggested strategy for displaying a thumbnail image.

### Parameters

***listingSource*** - A string representation of the MLS listing source (see FeedsModels.Models.enumListingSource)

***listingType*** - A string representation of the listing type such as residential, land etc.. (see FeedsModels.Models.enumListingType)

***listingId*** - The unique ID for the listing to retrieve the listing for

***photoId*** - A zero based index for the photo to retrieve *(see the photoCount that is returned in the listing details)*.

***width*** - The width to be used for resizing the photo

***height*** - The height to be used for resizing the photo

### Returns

A URL for the image specified

***

## executeDMQL
> Return MLS results via a DMQL query

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/RETSListing/RETSListing_ExecuteDMQL "")

```php
GetRETS::getRETSListing()->executeDMQL($query, $feedName, $listingType);
```
This is a powerful function that will execute raw DMQL against the RETS MLS server and will return the results as a serialized object.

***Special Note*** - These results will not be returned in a translated fashion similiar to the other listing detail searches.  These results are in the format as returned from the MLS RETS server.  If you wish to retrieve listings in a **translated** format use getListingsByDMQL.

### Parameters

***query*** - The DMQL to be executed against the MLS RETS server

***feedName*** - The name of the feed to run the query against

***listingType*** - A string representation of the listing type such as residential, land etc.. (see FeedsModels.Models.enumListingType)

### Returns

An enveloped response with the success or failure of the query, as well as the raw serialized results that were fetched.  These serialized results will be different for each feedName and listingType.

```
{
  "success": true,
  "code": 0,
  "message": "string",
  "data": [
    {
      "className": "string"
    }
  ]
}
```

***

## getListingsByDMQL
> Get translated listings by DMQL query

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/RETSListing/RETSListing_GetListingsByDMQL "")

```php
GetRETS::getRETSListing()->getListingsByDMQL($query, $feedName, $listingType);
```
This is a powerful function that will execute raw DMQL against the RETS MLS server and will return the results as a serialized object.  It is similar to executeDMQL, however this function will **translate** data to be in the same format as returned by other methods that retrieve listing details.

### Parameters

***query*** - The DMQL to be executed against the MLS RETS server

***feedName*** - The name of the feed to run the query against

***listingType*** - A string representation of the listing type such as residential, land etc.. (see FeedsModels.Models.enumListingType)

### Returns

An enveloped response with the success or failure of the query, as well as the raw serialized results that were fetched.

```
{
  "success": true,
  "code": 0,
  "message": "string",
  "data": [
    {
      "description": "string",
      "features": [
        "string"
      ],
      "photoCount": 0,
      "id": "string",
      "listingSourceURLSlug": "string",
      "listingTypeURLSlug": "string",
      "listingID": "string",
      "listingSource": 1,
      "listingType": 1,
      "address": "string",
      "baths": 0,
      "beds": 0,
      "listPrice": "string",
      "rawListPrice": 0,
      "providedBy": "string",
      "squareFeet": 0,
      "lot": "string",
      "acres": "string"
    }
  ]
}
```

***

# Geocoding
> The main controller for working with addresses

[Swagger Documentation](http://getrets.net/swagger/ui/index#/Geocoding "")

```php
GetRETS::getGeocoding();
```
This controller is a planned area of growth to provide more advanced geo-spatial style searching for listing data.  For the time being, it is used for parsing keywords into more geocoded data to be used for searching.

If you provide a google geocode key to be associated with your account, you can use these methods.

***

## parseGoogleResults
> Translates results returned by Google

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Geocoding/Geocoding_ParseGoogleResults "")

```php
GetRETS::getGeocoding()->parseGoogleResults($googleResults);
```

This function will parse the results returned from Google's service and translate them into a consistent format more suitable for searching the listing data.

### Parameters

***googleResults*** - Results from Google's geocoder.geocode
```
[
  {
    "address_components": [
      {
        "long_name": "string",
        "short_name": "string",
        "types": [
          "string"
        ]
      }
    ],
    "formatted_address": "string",
    "geometry": {
      "bounds": {
        "south": 0,
        "west": 0,
        "north": 0,
        "east": 0
      },
      "location": {
        "lat": 0,
        "lng": 0
      },
      "location_type": "string",
      "viewport": {
        "south": 0,
        "west": 0,
        "north": 0,
        "east": 0
      }
    },
    "place_id": "string",
    "types": [
      "string"
    ]
  }
]
```

### Returns

Data translated as **AddressDetail**'s.

```
[
  {
    "streetNumber": "string",
    "street": "string",
    "city": "string",
    "county": "string",
    "state": "string",
    "stateAbbreviation": "string",
    "country": "string",
    "postalCode": "string",
    "latitude": 0,
    "longitude": 0,
    "formattedAddress": "string"
  }
]
```

***

## googleGeocode
> Geocode address entered as free-form text

[Swagger Documentation](http://getrets.net/swagger/ui/index#!/Geocoding/Geocoding_GoogleGeocode "")

```php
GetRETS::getGeocoding()->googleGeocode($address);
```

This function will take a keyword and run it through Google's geocoding service and return the translated results.

### Parameters

***address*** - A free form text to geocode (The expectation is that this is a possible address)

### Returns

Data translated as **AddressDetail**'s.

```
[
  {
    "streetNumber": "string",
    "street": "string",
    "city": "string",
    "county": "string",
    "state": "string",
    "stateAbbreviation": "string",
    "country": "string",
    "postalCode": "string",
    "latitude": 0,
    "longitude": 0,
    "formattedAddress": "string"
  }
]
```

***

# Helper Functions
The following methods aren't API endpoints but are available in the SDK for assistance with the functionality.

***

## setSortBy / setReverseSort
> Used for sorting / ordering the results that are returned

```php
GetRETS::getListing()->setSortBy("providedBy")->setReverseSort(true)->searchByKeyword($preparedKeywords);
```

**setSortBy**

This property is used to set column by which the data is sorted.

**setReverseSort**

This property is used to set the order (ascending / descending) by which the sortBy column will ordered by. *(Default is false meaning ascending)*

By default listings will be sorted by the price from low to high.  If you want to change the defaults, you can modify these lines.

```php
private $sortBy = "rawListPrice";

private $reverseSort = false;
```

If you want to sort listings manually within any other portion of the app, you can use the setSortBy and setReverseSort methods as in the following syntax.

```php
$listings = $getRets->getListing()->setSortBy("providedBy")->setReverseSort(true)->searchByKeyword($preparedKeywords);
```

***

# Further Reading
More information on the API itself can be found at the Swagger UI (<http://getrets.net/swagger/>). 