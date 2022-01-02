export interface Paginated<T> {
    data: T;
    path: string;
    per_page: number;
    next_page_url: string;
    prev_page_url: string;
}