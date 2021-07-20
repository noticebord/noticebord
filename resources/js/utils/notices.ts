import { Notice } from "../client/models/Notice";
import { User } from "../client/models/User";

const defaultUser: User = {
    id: 0,
    name: "Anonymous",
    email: "",
    profile_photo_url: "https://ui-avatars.com/api/?name=Anonymous&color=7F9CF5&background=EBF4FF"
}

export function assignDefaultAuthor(notice: Notice) : Notice {
    notice.author ??= defaultUser;
    return notice;
}