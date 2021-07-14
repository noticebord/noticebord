import { User } from "./User";

export interface Notice {
    id: number;
    title: string;
    text: string;
    created_at: string;
    updated_at: string;
    author: User;
}