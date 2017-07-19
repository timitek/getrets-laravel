<?php

namespace Timitek\GetRETS\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use GetRETS;

class ExampleController extends Controller {

    const IS_PUBLIC = false;
    const EXAMPLE_ADDRESS = "sheridan, ar";
    const EXAMPLE_SOURCE = "CARMLS";

    /**
     * Used to determine if a specific action was specified
     * 
     * @param Request $request
     * @param type $action
     * @return type
     */
    private function isAction(Request $request, $action) {
        return array_key_exists($action, $request->all());
    }

    /**
     * Returns either the cached or non-cached listing controller
     * 
     * @param type $data
     * @return type
     */
    private function listingController($data) {
        return ($data["disableCache"] ? GetRETS::getRETSListing() : GetRETS::getListing());
    }

    /**
     * Handles requested action from a form post
     * 
     * @param Request $request
     * @param type $data
     */
    private function handleAction(Request $request, &$data) {
        // Keyword Search
        if ($this->isAction($request, "searchByKeyword")) {
            $preparedKeywords = htmlspecialchars($data["keywords"]);
            $data["listings"] = $this->listingController($data)
                    ->setSortBy($data["sortBy"])->setReverseSort($data["reverseSort"])
                    ->searchByKeyword($preparedKeywords);
        }
        // Advanced Search
        else if ($this->isAction($request, "search")) {
            $data["listings"] = $this->listingController($data)
                    ->setSortBy($data["sortBy"])->setReverseSort($data["reverseSort"])
                    ->search($data["keywords"], $data["extra"], $data["maxPrice"], $data["minPrice"], $data["beds"], $data["baths"], $data["includeResidential"], $data["includeLand"], $data["includeCommercial"]);
        }
        // Return Listings by DMQL
        else if ($this->isAction($request, "getListingsByDMQL")) {
            $results = GetRETS::getRETSListing()
                    ->setSortBy($data["sortBy"])->setReverseSort($data["reverseSort"])
                    ->getListingsByDMQL($data["dmql"], ExampleController::EXAMPLE_SOURCE, "Residential");
            if (!empty($results)) {
                if ($results->success && !empty($results->data)) {
                    $data["listings"] = $results->data;
                }
            }
        }
        // Return raw DMQL results
        else if ($this->isAction($request, "executeDMQL")) {
            $data["rawData"] = GetRETS::getRETSListing()->executeDMQL($data["dmql"], ExampleController::EXAMPLE_SOURCE, "Residential");
        }
    }

    /**
     * Returns an array of data to be used in the view
     * 
     * @param Request $request
     * @return type
     */
    private function getPageData(Request $request) {

        $publicDMQL = '(L_UpdateDate=' . date('Y-m-d', (strtotime('-1 day', time()))) . '-' . date('Y-m-d') . ')';

        $data = [
            "isPublic" => ExampleController::IS_PUBLIC,
            "disableCache" => !empty($request->disableCache),
            "keywords" => $request->keywords ? : ExampleController::EXAMPLE_ADDRESS,
            "extra" => $request->extra,
            "maxPrice" => $request->maxPrice,
            "minPrice" => $request->minPrice,
            "beds" => $request->beds,
            "baths" => $request->baths,
            "includeResidential" => $request->includeResidential,
            "includeLand" => $request->includeLand,
            "includeCommercial" => $request->includeCommercial,
            "sortBy" => $request->sortBy ? : "rawListPrice",
            "reverseSort" => !empty($request->reverseSort),
            // Only let the public search the last days worth of modified residential listings (to prevent abusive queries)
            "dmql" => (!empty($request->dmql) && !$data["isPublic"]) ? $request->dmql : $publicDMQL,
            "listings" => null,
            "detail" => null,
            "rawData" => null,
            "allInput" => $request->all(),
        ];

        if ($request->isMethod('POST')) {
            $this->handleAction($request, $data);
        }

        // Listing Details
        if ($request->has("source") && $request->has("type") && $request->has("id")) {
            $data["detail"] = $this->listingController($data)->details($request->source, $request->type, $request->id);
        }

        return $data;
    }

    /**
     * Default route handler
     * 
     * @param Request $request
     * @return type
     */
    public function index(Request $request) {
        return view('GetRETS::example.index', ['data' => $this->getPageData($request)]);
    }

}
