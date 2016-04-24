data<-read.delim("data/uniprot-organism-34305.tab", header=F)
data$id<-data$V1
data$label1<-gsub("_.*",'',data$V2)
data$label<-toupper(gsub(" ",'_',data$V5))
data[data$label=="","label"]<-data[data$label=="","label1"]
data$title<-gsub("\\(.*",'',data$V4)
data[data$title=="Uncharacterized protein","title"]<-''
write.table(data[,c("id","label","title")], "data/uniprot-corrected.tab",sep="\t",row.names=F,col.names=F)