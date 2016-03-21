//-------------------------------------------------------
//
// A program to create a json file from a text file
// filed with questions
//
//-------------------------------------------------------

#include <iostream>
#include <fstream>
#include <string>

using namespace std;

int main()
{
 ifstream infile;
 ofstream outfile;

 infile.open("demographicQuestions.txt");
 if(infile.fail())
 {
   cerr << "Error opening dem file!" << endl;
   exit(EXIT_FAILURE);
 }

 outfile.open("temp.json");
 if (outfile.fail())
 {
   cerr << "Error opening output file!" << endl;
   exit(EXIT_FAILURE);
 }

  string line = "";
  string holder = "";
  string noComma = "";
  string correctLine = "";
  string question = "question";
  int i = 0;

  outfile << "{" << endl;

  while(getline(infile, line))
  {
    if(i % 2 == 0)
    {
      line = '"' + question + line + '"' + ":";
      outfile << line;
      holder = line;
    }
    else
    {
      line = line + ",";
      outfile << line << endl;
      holder += line;
    }
    i++;
  }

  outfile << "}" << endl;
  infile.close();
  outfile.close();

  noComma = holder.substr(0, holder.size()-1);

  infile.open("temp.json");
  if(infile.fail())
  {
   cerr << "Error opening temp file!" << endl;
   exit(EXIT_FAILURE);
  }

  outfile.open("demographicQuestions.json");
  if(outfile.fail())
  {
   cerr << "Error opening temp file!" << endl;
   exit(EXIT_FAILURE);
  }

  while(getline(infile, line))
  {
    if(line == holder)
    {
      outfile << noComma << endl;
    }
    else{
      outfile << line << endl;
    }
  }

  infile.close();
  outfile.close();

//-------------------------------------------------------

  infile.open("likertScaleQuestions.txt");
  if(infile.fail())
  {
    cerr << "Error opening likert file!" << endl;
    exit(EXIT_FAILURE);
  }

  outfile.open("temp.json");
  if (outfile.fail())
  {
    cerr << "Error opening output file!" << endl;
    exit(EXIT_FAILURE);
  }

  i = 0;
  outfile << "{" << endl;

  while(getline(infile, line))
  {
    if(i % 2 == 0)
    {
      line = '"' + question + line + '"' + ":";
      outfile << line;
      holder = line;
    }
    else
    {
      line = line + ",";
      outfile << line << endl;
      holder += line;
    }
    i++;
  }

  outfile << "}" << endl;
  infile.close();
  outfile.close();

  noComma = holder.substr(0, holder.size()-1);

  infile.open("temp.json");
  if(infile.fail())
  {
    cerr << "Error opening temp file!" << endl;
    exit(EXIT_FAILURE);
  }

  outfile.open("likertScaleQuestions.json");
  if(outfile.fail())
  {
    cerr << "Error opening temp file!" << endl;
    exit(EXIT_FAILURE);
  }

  while(getline(infile, line))
  {
    if(line == holder)
    {
      outfile << noComma << endl;
    }
    else{
      outfile << line << endl;
    }
  }

  infile.close();
  outfile.close();

  return 0;
}
