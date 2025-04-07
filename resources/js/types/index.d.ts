export interface Listing {
    id: number;
    beds: number;
    baths: number;
    area: number;
    city: string;
    code: string;
    street: string;
    street_num: string;
    price: number;
    created_at: string;
    updated_at: string;
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface ListingFilters {
    priceFrom: number | null,
    priceTo: number | null,
    beds: string | null,
    baths: string | null,
    areaFrom: number | null,
    areaTo: number | null
}

export interface RealtorListingFilters {
    by: string,
    order: string,
    deleted: boolean
}

export interface ListingsResponse {
    current_page: number;
    data: Listing[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url: any;
    to: number;
    total: number;
}
