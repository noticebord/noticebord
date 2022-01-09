export interface SaveNoticeRequest {
    title: string;
    body: string;
    topics: string[];
    anonymous: boolean;
    public: boolean;
}