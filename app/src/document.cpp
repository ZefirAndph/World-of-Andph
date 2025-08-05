#include "document.hpp"

Document::Document(const std::filesystem::path& path) : mPath(path) {
    if(std::filesystem::exists(mPath)) {
        // ToDo: Load
    }
}