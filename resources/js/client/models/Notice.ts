import { Topic, User } from ".";

// TODO: Separate into different interfaces
// One should have body and the other shouldn't
export interface Notice {
    id: number;
    title: string;
    body?: string;
    created_at: string;
    updated_at: string;
    author?: User;
    topics: Topic[];
}