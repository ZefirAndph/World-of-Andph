#ifndef DOCUMENT_HPP
#define DOCUMENT_HPP

class Document {
    private:
        std::filesystem::path mPath;
    public:
        Document(const std::filesystem::path& path) : mPath(path) {};


};

#endif