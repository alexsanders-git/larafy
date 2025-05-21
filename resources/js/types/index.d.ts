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
    deleted_at: string;
    images_count?: number;
    offers_count?: number;
    images: ListingImages[];
    offers: Offer[];
    sold_at: string | null;
}

export interface ListingImages {
    id: number;
    created_at: string;
    updated_at: string;
    filename: string;
    listing_id: number;
    src: string;
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
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

export interface Offer {
    id: number;
    created_at: string;
    updated_at: string;
    listing_id: number;
    bidder_id: number;
    amount: number;
    accepted_at: number | null;
    rejected_at: number | null;
    bidder: Bidder;
}

export interface Bidder {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    created_at: string;
    updated_at: string;
    is_admin: number;
}

export interface NotificationsResponse {
    current_page: number;
    data: Notifications[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: any;
    path: string;
    per_page: number;
    prev_page_url: any;
    to: number;
    total: number;
}

export interface Notifications {
    id: string;
    type: string;
    notifiable_type: string;
    notifiable_id: number;
    data: {
        offer_id: number
        listing_id: number
        bidder_id: number
        amount: number
    };
    read_at: any;
    created_at: string;
    updated_at: string;
}
